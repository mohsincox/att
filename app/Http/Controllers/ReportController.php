<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Process;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Input;

class ReportController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function ownForm()
    {
    	return view('report.own.form');
    }

    public function ownShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';

        $ownData = Attendance::with(['user', 'user.department'])->where('attendance_id', Auth::user()->attendance_id)->whereBetween('login', [$startDateTime, $endDateTime])->get();
        
        return view('report.own.show', compact('ownData', 'startDate', 'endDate')); 
    }

    public function superForm()
    {
        if (Auth::id() == 11 ) {
            // Mohsin for test
            // $processes = ["N/A"];
            $processes = [25];
        } else if (Auth::id() == 76 ) {
            // Nazmul
            // $processes = ["Transcom Telesales"];
            $processes = [2];
        } else if (Auth::id() == 12 ) {
            // Sharif
            // $processes = ["Coca Cola", "FDL"];
            $processes = [15, 20];
        } else if (Auth::id() ==  78) {
            // Monir
            // $processes = ["Abul Khair", "Short Campaign"];
            $processes = [10, 23];
        } else if (Auth::id() == 55 ) {
            // Sharif Nestle
            // $processes = ["Nestle"];
            $processes = [1];
        } else if (Auth::id() == 387 ) {
            // Anwar
            // $processes = ["Fresh", "Mediacom", "Midea BD", "Supermom"];
            $processes = [14, 17, 19, 26];
        } else if (Auth::id() == 74 ) {
            // Akram
            // $processes = ["Transcom Telesales","Arla Foods", "Tasty Tibet", "Best Electronics"];
            $processes = [3, 9, 18, 22];
        } else if (Auth::id() == 75 ) {
            // Toru
            // $processes = ["Mahindra", "Berger", "Karnafully"];
            $processes = [8, 11, 21];
        } else if (Auth::id() == 86 ) {
            // Faria
            // $processes = ["Emami", "Incepta", "Incepta-fb"];
            $processes = [5, 6, 7];
        } else if (Auth::id() == 192 ) {
            // Fahad
            // $processes = ["Sheba"];
            $processes = [4];
        } else if (Auth::id() == 301 ) {
            // Alamgir
            // $processes = ["SFBL", "Igloo", "Coco-Cola (Short Camp)"];
            $processes = [12, 13, 16];
        } else if (Auth::id() == 299 ) {
            // Rifat Ara
            // $processes = ["Apex"];
            $processes = [24];
        } else {
            $processes = [];
        }

        $processList = Process::whereIn('id', $processes)->pluck('name', 'id');

        return view('report.super.form', compact('processList'));
    }

    public function superShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';
        $processId = $request->process_id;
        $process = Process::find($processId);

        // $users = User::where('process_id', $processId)->get();
        // $arrayUser = [];
        // foreach($users as $value){
        //     $arrayUser[] = $value['attendance_id'];
        // }
        // print_r($arrayUser);

        // $superData = Attendance::whereIn('attendance_id', $arrayUser)->whereBetween('entry_date', [$startDate, $endDate])->get();


        $superData = Attendance::join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name')
            ->where('users.process_id', $processId)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->get();

        // return $superData = Attendance::with('user')
        //     ->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
        //     ->where('users.process_id', $processId)
        //     ->whereBetween('login', [$startDateTime, $endDateTime])
        //     ->get();

        // return $superData = Attendance::with(['user' => function ($query) use($processId) {
        //     $query->where('process_id', $processId);
        // }])->whereBetween('login', [$startDateTime, $endDateTime])->get();

        // return $superData = User::with(['attendance' => function ($query) use($startDateTime, $endDateTime, $processId) {
        //     $query->whereBetween('login', [$startDateTime, $endDateTime]);
        // }])->where('process_id', $processId)->get();

        return view('report.super.show', compact('superData', 'startDate', 'endDate', 'process'));
        // return view('report.super.show',[
        //     'superData' => $superData->appends(Input::except('page'))
        // ], compact('superData', 'startDate', 'endDate', 'process'));
    }

    public function empForm()
    {
        return view('report.emp.form');
    }

    public function empShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';
        $deptIdArr = [1, 2, 3, 4, 5, 6, 7];

        // $empData = Attendance::whereIn('attendance_id', [101, 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 124, 125, 130, 137, 138, 139, 140])->whereBetween('entry_date', [$startDate, $endDate])->get();

         $empData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name')
            ->whereIn('users.department_id', $deptIdArr)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->orderBy('attendances.attendance_id', 'asc')
            ->orderBy('attendances.login', 'asc')
            ->get();

        return view('report.emp.show', compact('empData', 'startDate', 'endDate'));
    }

    public function idWiseForm()
    {
    	// $attenIdList = Attendance::groupBy('attendance_id')->pluck('attendance_id', 'attendance_id');
        $attenIdList = User::where('attendance_id', '<>', 0)->orderBy('attendance_id', 'asc')->pluck('attendance_id', 'attendance_id');

    	return view('report.id_wise.form', compact('attenIdList'));
    }

    public function idWiseShow(Request $request)
    {
        $attenId = $request->attendance_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';

        $idWiseData = Attendance::with(['user', 'user.department'])->where('attendance_id', $attenId)->whereBetween('login', [$startDateTime, $endDateTime])->get();

    	return view('report.id_wise.show', compact('idWiseData', 'attenId', 'startDate', 'endDate'));
    }

    public function idWiseShown()
    {
        return view('report.id_wisen.index');
    }

    public function deptWiseForm()
    {
        $deptList = Department::pluck('name', 'id');

        return view('report.dept_wise.form', compact('deptList'));
    }

    public function deptWiseShow(Request $request)
    {

        $deptId = $request->department_id;
        $department = Department::find($deptId);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $deptWiseData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name')
            ->where('users.department_id', $deptId)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->orderBy('attendances.attendance_id', 'asc')
            ->orderBy('login', 'asc')
            ->get();

        return view('report.dept_wise.show', compact('deptWiseData', 'department', 'startDate', 'endDate'));
    }

    public function desigWiseForm()
    {
        $desigList = Designation::pluck('name', 'id');

        return view('report.desig_wise.form', compact('desigList'));
    }

    public function desigWiseShow(Request $request)
    {

        $desigId = $request->designation_id;
        $designation = Designation::find($desigId);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $desigWiseData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name')
            ->where('users.designation_id', $desigId)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->orderBy('attendances.attendance_id', 'asc')
            ->orderBy('login', 'asc')
            ->get();

        return view('report.desig_wise.show', compact('desigWiseData', 'designation', 'startDate', 'endDate'));
    }

    public function processWiseForm()
    {
        $processList = Process::orderBy('name', 'asc')->pluck('name', 'id');

        return view('report.process_wise.form', compact('processList'));
    }

    public function processWiseShow(Request $request)
    {

        $processId = $request->process_id;
        $process = Process::find($processId);
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $processWiseData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name')
            ->where('users.process_id', $processId)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->orderBy('attendances.attendance_id', 'asc')
            ->orderBy('login', 'asc')
            ->get();

        return view('report.process_wise.show', compact('processWiseData', 'process', 'startDate', 'endDate'));
    }

    public function allUserForm()
    {
        return view('report.all_user.form');
    }

    public function allUserShow(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';

        $allUserData = Attendance::join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('designations', 'designations.id', '=', 'users.designation_id')
            ->join('processes', 'processes.id', '=', 'users.process_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name', 'departments.name AS deptName', 'designations.name AS desigName', 'processes.name AS processName')
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->orderBy('attendances.attendance_id', 'asc')
            ->orderBy('login', 'asc')
            ->get();

        return view('report.all_user.show', compact('allUserData', 'startDate', 'endDate'));
    }
}
