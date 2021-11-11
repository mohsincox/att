<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Leave;
use App\Models\LeaveDetail;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        // return date('Y').'-01-01 00:00:00';
    	$ownLeaves = Leave::where('applicant_id', Auth::id())->get();

    	return view('leave.index', compact('ownLeaves'));
    }

    public function create()
    {
    	$lineManagerList = User::whereIn('id', [1, 5, 4, 17, 19, 407])->pluck('name', 'id');

    	return view('leave.create', compact('lineManagerList'));
    }

    public function store(Request $request)
    {
        //return $request->all();
    	$input = Input::all();
	    $rules = [
	    	'line_manager_id' => 'required',
	    	'leave_type' => 'required',
	    	'from_date' => 'required',
	    	'to_date' => 'required',
	    	'total_days_off' => 'required|numeric',
	    ];
	    $messages = [
            'line_manager_id.required' => 'The line manager field is required.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDateTime = date('Y').'-01-01 00:00:00';
        $endDateTime = date('Y').'-12-31 23:59:59';

        if ($request->leave_type == 'Sick Leave') {

        	$sickTotalCount = Auth::user()->sick_leave;
        	$sickTaken = Leave::where('applicant_id', Auth::id())->where('leave_type', 'Sick Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $sickTakenCount = 0;
            foreach ($sickTaken as $value) {
                $sickTakenCount +=  $value->total_days_off;
            }

        	if ($sickTakenCount >= $sickTotalCount) {
        		flash()->error('There is no available Sick Leave.');
    			return redirect()->back()->withInput();
        	}

        	$sickReqTakenCount = $request->total_days_off + $sickTakenCount;

        	if ($sickReqTakenCount > $sickTotalCount) {
        		flash()->error('Your Sick Leave limit cross.');
    			return redirect()->back()->withInput();
        	}

        } else if ($request->leave_type == 'Casual Leave') {

        	$casualTotalCount = Auth::user()->casual_leave;
        	$casualTaken = Leave::where('applicant_id', Auth::id())->where('leave_type', 'Casual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $casualTakenCount = 0;
            foreach ($casualTaken as $value) {
                $casualTakenCount +=  $value->total_days_off;
            }

        	if ($casualTakenCount >= $casualTotalCount) {
        		flash()->error('There is no available casual Leave.');
    			return redirect()->back()->withInput();
        	}

        	$casualReqTakenCount = $request->total_days_off + $casualTakenCount;

        	if ($casualReqTakenCount > $casualTotalCount) {
        		flash()->error('Your casual Leave limit cross.');
    			return redirect()->back()->withInput();
        	}
        } else if ($request->leave_type == 'Annual Leave') {

        	$annualTotalCount = Auth::user()->annual_leave;
        	$annualTaken = Leave::where('applicant_id', Auth::id())->where('leave_type', 'Annual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $annualTakenCount = 0;
            foreach ($annualTaken as $value) {
                $annualTakenCount +=  $value->total_days_off;
            }

        	if ($annualTakenCount >= $annualTotalCount) {
        		flash()->error('There is no available annual Leave.');
    			return redirect()->back()->withInput();
        	}

        	$annualReqTakenCount = $request->total_days_off + $annualTakenCount;

        	if ($annualReqTakenCount > $annualTotalCount) {
        		flash()->error('Your annual Leave limit cross.');
    			return redirect()->back()->withInput();
        	}
        }

        // return 'right';

        $leave = new Leave;
        $leave->applicant_id = Auth::id();
        $leave->line_manager_id = $request->line_manager_id;
        $leave->leave_type = $request->leave_type;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->total_days_off = $request->total_days_off;
        $leave->contract_during_leave = $request->contract_during_leave;
        $leave->remarks = $request->remarks;
        $leave->line_manager_status = 'Pending';
        $leave->hr_status = 'Pending';
        $leave->created_by = Auth::id();
        $leave->save();

        $leaveDetail = new LeaveDetail;
        $leaveDetail->leave_id = $leave->id;
        $leaveDetail->status = 'Pending';
        $leaveDetail->remarks = $request->remarks;
        $leaveDetail->created_by = Auth::id();
        $leaveDetail->save();

        flash()->success($leave->leave_type.'  applied successfully');
    	return redirect('leave');
    }

    public function show($id)
    {
       $leave = Leave::with(['leaveDetails', 'applicant.department'])->find($id);

        return view('leave.show', compact('leave'));
    }

    public function lineManagerIndex()
    {
        $lineManageLeaves = Leave::where('line_manager_id', Auth::id())->get();

        return view('leave.line_manager_index', compact('lineManageLeaves'));
    }

    public function lineManagerEdit($id)
    {
        $userId = [1, 5, 4, 17, 19, 407];

        if (in_array(Auth::id(), $userId)) {
            $leave = Leave::with(['leaveDetails', 'applicant.department'])->find($id);
            return view('leave.line_manager_edit', compact('leave'));
        } else {
            flash()->error('No permission');

            return redirect()->back();
        }
        
    }

    public function lineManagerUpdate(Request $request, $id)
    {
        $leave = Leave::find($id);
        $input = Input::all();
        $rules = [
            'line_manager_status' => 'required',
        ];
        $messages = [
            'line_manager_status.required' => 'The Line Manager Status field is required.',
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDateTime = date('Y').'-01-01 00:00:00';
        $endDateTime = date('Y').'-12-31 23:59:59';

        $applicant = User::find($leave->applicant_id);

        if ($leave->leave_type == 'Sick Leave') {

            $sickTotalCount = $applicant->sick_leave;
            $sickTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Sick Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $sickTakenCount = 0;
            foreach ($sickTaken as $value) {
                $sickTakenCount +=  $value->total_days_off;
            }

            if ($sickTakenCount >= $sickTotalCount) {
                flash()->error('There is no available Sick Leave.');
                return redirect()->back()->withInput();
            }

            $sickReqTakenCount = $leave->total_days_off + $sickTakenCount;

            if ($sickReqTakenCount > $sickTotalCount) {
                flash()->error('Your Sick Leave limit cross.');
                return redirect()->back()->withInput();
            }

        } else if ($leave->leave_type == 'Casual Leave') {

            $casualTotalCount = $applicant->casual_leave;
            $casualTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Casual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $casualTakenCount = 0;
            foreach ($casualTaken as $value) {
                $casualTakenCount +=  $value->total_days_off;
            }

            if ($casualTakenCount >= $casualTotalCount) {
                flash()->error('There is no available casual Leave.');
                return redirect()->back()->withInput();
            }

            $casualReqTakenCount = $leave->total_days_off + $casualTakenCount;

            if ($casualReqTakenCount > $casualTotalCount) {
                flash()->error('Your casual Leave limit cross.');
                return redirect()->back()->withInput();
            }
        } else if ($leave->leave_type == 'Annual Leave') {

            $annualTotalCount = $applicant->annual_leave;
            $annualTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Annual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $annualTakenCount = 0;
            foreach ($annualTaken as $value) {
                $annualTakenCount +=  $value->total_days_off;
            }

            if ($annualTakenCount >= $annualTotalCount) {
                flash()->error('There is no available annual Leave.');
                return redirect()->back()->withInput();
            }

            $annualReqTakenCount = $leave->total_days_off + $annualTakenCount;

            if ($annualReqTakenCount > $annualTotalCount) {
                flash()->error('Your annual Leave limit cross.');
                return redirect()->back()->withInput();
            }
        }

        $leave->line_manager_status = $request->line_manager_status;
        $leave->updated_by = Auth::id();
        $leave->save();

        $leaveDetail = new LeaveDetail;
        $leaveDetail->leave_id = $leave->id;
        $leaveDetail->status = $request->line_manager_status;
        $leaveDetail->remarks = $request->remarks_update;
        $leaveDetail->created_by = Auth::id();
        $leaveDetail->save();

        
        flash()->success('leave ID '.$leave->id.' updated successfully');

        return redirect('/line-manager-leave');
    }

    public function hrIndex()
    {
        $hrLeaves = Leave::get();

        return view('leave.hr_index', compact('hrLeaves'));
    }

    public function hrEdit($id)
    {
        $userId = [5];

        if (in_array(Auth::id(), $userId)) {
            $leave = Leave::with(['leaveDetails', 'applicant.department'])->find($id);
            return view('leave.hr_edit', compact('leave'));
        } else {
            flash()->error('Only HRM  has permission');

            return redirect()->back();
        }
    }

    public function hrUpdate(Request $request, $id)
    {
        $leave = Leave::find($id);
        $input = Input::all();
        $rules = [
            'hr_status' => 'required',
        ];
        $messages = [
            'hr_status.required' => 'The HR Status field is required.',
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $startDateTime = date('Y').'-01-01 00:00:00';
        $endDateTime = date('Y').'-12-31 23:59:59';

        $applicant = User::find($leave->applicant_id);

        if ($leave->leave_type == 'Sick Leave') {

            $sickTotalCount = $applicant->sick_leave;
            $sickTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Sick Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $sickTakenCount = 0;
            foreach ($sickTaken as $value) {
                $sickTakenCount +=  $value->total_days_off;
            }

            if ($sickTakenCount >= $sickTotalCount) {
                flash()->error('There is no available Sick Leave.');
                return redirect()->back()->withInput();
            }

            $sickReqTakenCount = $leave->total_days_off + $sickTakenCount;

            if ($sickReqTakenCount > $sickTotalCount) {
                flash()->error('Your Sick Leave limit cross.');
                return redirect()->back()->withInput();
            }

        } else if ($leave->leave_type == 'Casual Leave') {

            $casualTotalCount = $applicant->casual_leave;
            $casualTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Casual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $casualTakenCount = 0;
            foreach ($casualTaken as $value) {
                $casualTakenCount +=  $value->total_days_off;
            }

            if ($casualTakenCount >= $casualTotalCount) {
                flash()->error('There is no available casual Leave.');
                return redirect()->back()->withInput();
            }

            $casualReqTakenCount = $leave->total_days_off + $casualTakenCount;

            if ($casualReqTakenCount > $casualTotalCount) {
                flash()->error('Your casual Leave limit cross.');
                return redirect()->back()->withInput();
            }
        } else if ($leave->leave_type == 'Annual Leave') {

            $annualTotalCount = $applicant->annual_leave;
            $annualTaken = Leave::where('applicant_id', $applicant->id)->where('leave_type', 'Annual Leave')->where('hr_status', 'Approved')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();

            $annualTakenCount = 0;
            foreach ($annualTaken as $value) {
                $annualTakenCount +=  $value->total_days_off;
            }

            if ($annualTakenCount >= $annualTotalCount) {
                flash()->error('There is no available annual Leave.');
                return redirect()->back()->withInput();
            }

            $annualReqTakenCount = $leave->total_days_off + $annualTakenCount;

            if ($annualReqTakenCount > $annualTotalCount) {
                flash()->error('Your annual Leave limit cross.');
                return redirect()->back()->withInput();
            }
        }

        $leave->hr_status = $request->hr_status;
        $leave->updated_by = Auth::id();
        $leave->save();

        $leaveDetail = new LeaveDetail;
        $leaveDetail->leave_id = $leave->id;
        $leaveDetail->status = $request->hr_status;
        $leaveDetail->remarks = $request->remarks_update;
        $leaveDetail->created_by = Auth::id();
        $leaveDetail->save();

        
        flash()->success('leave ID '.$leave->id.' updated successfully');

        return redirect('/hr-leave');
    }
}
