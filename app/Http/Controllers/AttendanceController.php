<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Attendance;
use App\Models\Option;
use Excel;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $attendances = Attendance::orderBy('id', 'DESC')->paginate(15);

        return view('attendance.index', compact('attendances'));
    }

    // public function create()
    // {
    //     $userId = [11, 18];

    //     if (in_array(Auth::id(), $userId)) {
    //         return view('attendance.create');
    //     } else {
    //         flash()->error('No permission to Upload');

    //         return redirect()->back();
    //     }
    // }

 //    public function store(Request $request)
	// {
	// 	$input = Input::all();
	//     $rules = [
	//     	'file' => 'required|mimes:xlsx,xls'
	//     	//'file' => 'required|mimes:xlsx,xls,csv,txt'
	//     ];
	//     $messages = [];
	    
 //    	$validator = Validator::make($input, $rules, $messages);
 //        if ($validator->fails()) {
 //        	flash()->error('Something Wrong!');
 //            return redirect()->back()
 //                        ->withErrors($validator)
 //                        ->withInput();
 //        }

	// 	if(Input::hasFile('file')){
	// 		$path = Input::file('file')->getRealPath();
	// 		$results=Excel::load($path)->get();
	// 		foreach ($results as $row) {
				
	// 			$entryTime = strtotime($row->entry_date);
	// 			$entryDate = date('Y-m-d', $entryTime);

	// 		  	Attendance::create([
	// 		        'attendance_id' => $row->attendance_id,
	// 		        'employee_name' => $row->employee_name,
	// 		        'department_name' => $row->department_name,
	// 		        'entry_date' => $entryDate,
	// 		        'day_of_week' => $row->day_of_week,
	// 		        'leave_or_absent' => $row->leave_or_absent,
	// 		        'login' => $row->login,
	// 		        'logout' => $row->logout,
	// 		        'created_by' => Auth::id()
	// 		    ]);
	// 		}
 //  			flash()->success('Excel file imported successfully');
 //   			return redirect()->back();
	// 	}
	// 	flash()->error('Something Wrong.');
 //        return redirect()->back();
	// }

	public function edit($id)
    {
        // $attendance = Attendance::find($id);
        // return view('attendance.edit', compact('attendance'));

        $userId = [5, 13, 14];

        if (in_array(Auth::id(), $userId)) {
            $attendance = Attendance::find($id);
        	return view('attendance.edit', compact('attendance'));
        } else {
            flash()->error('Only HRM dept. has permission to give Remarks');

            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->hr_remarks = $request->hr_remarks;
        $attendance->hr_updated_by = Auth::id();
        $attendance->updated_by = Auth::id();
        $attendance->save();
        flash()->success($attendance->hr_remarks.' Remarks updated successfully');
        return redirect()->back();
    }

    public function ownEdit($id)
    {
        $attendance = Attendance::find($id);
        $statusList  = Option::where('select_id', 1)->where('status', 'Active')->orderBy('name', 'asc')->pluck('name', 'name');
        return view('attendance.own_edit', compact('attendance', 'statusList'));
    }

    public function ownUpdate(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->own_status = $request->own_status;
        $attendance->own_remarks = $request->own_remarks;
        $attendance->own_updated_by = Auth::id();
        $attendance->updated_by = Auth::id();
        $attendance->save();
        flash()->success($attendance->own_remarks.' Own Remarks updated successfully');
        return redirect('own-form');
    }

    public function superEdit($id)
    {
        $attendance = Attendance::find($id);
        return view('attendance.super_edit', compact('attendance'));
    }

    public function superUpdate(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->super_remarks = $request->super_remarks;
        $attendance->super_updated_by = Auth::id();
        $attendance->updated_by = Auth::id();
        $attendance->save();
        flash()->success($attendance->super_remarks.' Super Remarks updated successfully');
        return redirect()->back();
    }

}
