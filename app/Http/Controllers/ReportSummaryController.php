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
use DB;
use Response;

class ReportSummaryController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function deptWiseSummaryForm()
    {
        $deptList = Department::pluck('name', 'id');

        return view('report.dept_wise_summary.form', compact('deptList'));
    }

    public function deptWiseSummaryShow(Request $request)
    {
    	// return $request->all();
    	$deptId = $request->department_id;
    	$department = Department::find($deptId);
    	$deptUsers = User::where('department_id', $deptId)->where('status', 'Active')->get();
    	$ymArr = explode("-",$request->month);
    	$year = date($ymArr[0]);
    	$month = date($ymArr[1]);
    	$day_count = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    	$fridays = array();
    	$saturdays = [];
    	for ($i = 1; $i <= $day_count; $i++) {

	        $date = $year.'/'.$month.'/'.$i; 
	        $get_name = date('l', strtotime($date)); 
	        $day_name = substr($get_name, 0, 3); 

	        if($day_name == 'Fri'){
	            $fridays[] = $i;
	        }

	        if($day_name == 'Sat'){
	            $saturdays[] = $i;
	        }

		}

		$fridaysCount = count($fridays);
		$saturdaysCount = count($saturdays);

    	// return $request->month;
    	// exit();

    	$yearMonth = strtotime ($request->month);
    	$startDate = date ('Y-m-d', strtotime ('first day of this month', $yearMonth));
	
		$endDate = date ('Y-m-d', strtotime ('last day of this month', $yearMonth));

		$startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';

        // Atten
        $deptWiseAttenData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'users.attendance_id AS attendanceId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name', DB::raw('count(*) as total') )
            ->where('users.department_id', $deptId)
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->groupBy('attendances.attendance_id')
            ->get();


        // Late
        $deptWiseLateData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'users.attendance_id AS attendanceId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name', DB::raw('count(*) as total') )
            ->where('users.department_id', $deptId)
            ->whereTime('login', '>', '09:30:59')
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->groupBy('attendances.attendance_id')
            ->get();


        // Overtime
        $deptWiseOvertimeData = Attendance::with('user')->join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
            ->select('attendances.id AS attId', 'users.id AS userId', 'users.attendance_id AS attendanceId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name', DB::raw('count(*) as total') )
            ->where('users.department_id', $deptId)
            ->whereTime('logout', '>=', '19:00:00')
            ->whereBetween('login', [$startDateTime, $endDateTime])
            ->groupBy('attendances.attendance_id')
            ->get();

        return view('report.dept_wise_summary.show', compact('deptUsers', 'deptWiseAttenData', 'deptWiseLateData', 'deptWiseOvertimeData', 'department', 'startDate', 'endDate', 'fridaysCount', 'saturdaysCount', 'day_count'));
    }

    public function idWiseSummaryShow(Request $request)
    {
        $attenId = $request->attendance_id;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';

        $idWiseData = Attendance::with(['user', 'user.department'])->where('attendance_id', $attenId)->whereBetween('login', [$startDateTime, $endDateTime])->get();

    	return view('report.dept_wise_summary.id_show', compact('idWiseData', 'attenId', 'startDate', 'endDate'));
    }
}
