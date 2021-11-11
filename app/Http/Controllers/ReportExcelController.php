<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Attendance;
use Excel;

class ReportExcelController extends Controller
{
	public function __construct()
    {
    	$this->middleware('auth');
    }

    public function idWiseFormExcel()
    {
    	$attenIdList = Attendance::groupBy('attendance_id')->pluck('attendance_id', 'attendance_id');

    	return view('report.id_wise.form_excel', compact('attenIdList'));
    }

    public function idWiseShowExcel(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $type = $request->type;
        $attenId = $request->attendance_id;

        Excel::create('ID_'.$attenId.'_'.$startDate.'_to_'.$endDate, function($excel) use ($attenId, $startDate, $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($attenId, $startDate, $endDate, $type) {

                
                $idWiseData = Attendance::where('attendance_id', $attenId)->whereBetween('entry_date', [$startDate, $endDate])->get();

                $arr =array();
                foreach($idWiseData as $idWise) {
                   
                    $data =  array($idWise->attendance_id, $idWise->employee_name, $idWise->department_name, $idWise->entry_date, $idWise->day_of_week, $idWise->leave_or_absent, $idWise->login, $idWise->logout, $idWise->own_remarks, $idWise->super_remarks, $idWise->hr_remarks);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'No.', 'Name', 'Dept. or Process', 'Date', 'Week', 'Absent', 'Clock In', 'Clock Out', 'Own Remarks', 'Super Remarks', 'HR Remarks'
                    )

                );

            });

        })->export($type);
    }

    public function deptWiseFormExcel()
    {
    	$deptList = Attendance::groupBy('department_name')->pluck('department_name', 'department_name');

    	return view('report.dept_wise.form_excel', compact('deptList'));
    }

    public function deptWiseShowExcel(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $type = $request->type;
        $department = $request->department_name;

        Excel::create('Dept_'.$department.'_'.$startDate.'_to_'.$endDate, function($excel) use ($department, $startDate, $endDate, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($department, $startDate, $endDate, $type) {
                
                $deptWiseData = Attendance::where('department_name', $department)->whereBetween('entry_date', [$startDate, $endDate])->get();

                $arr =array();
                foreach($deptWiseData as $deptWise) {
                   
                    $data =  array($deptWise->attendance_id, $deptWise->employee_name, $deptWise->department_name, $deptWise->entry_date, $deptWise->day_of_week, $deptWise->leave_or_absent, $deptWise->login, $deptWise->logout, $deptWise->own_remarks, $deptWise->super_remarks, $deptWise->hr_remarks);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'No.', 'Name', 'Dept. or Process', 'Date', 'Week', 'Absent', 'Clock In', 'Clock Out', 'Own Remarks', 'Super Remarks', 'HR Remarks'
                    )

                );

            });

        })->export($type);
    }

    public function allUserFormExcel()
    {
        return view('report.all_user.form_excel');
    }

    public function allUserShowExcel(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->end_date . ' 23:59:59';
        $type = $request->type;

        Excel::create('All_Users_'.$startDate.'_to_'.$endDate, function($excel) use ($startDateTime, $endDateTime, $type) {

            $excel->sheet('Sheet1', function($sheet) use ($startDateTime, $endDateTime, $type) {

                
                $allUserData = Attendance::join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->join('designations', 'designations.id', '=', 'users.designation_id')
                    ->join('processes', 'processes.id', '=', 'users.process_id')
                    ->select('attendances.id AS attId', 'users.id AS userId', 'attendances.login', 'attendances.logout', 'attendances.own_status', 'attendances.own_remarks', 'attendances.super_remarks', 'attendances.hr_remarks', 'users.name', 'departments.name AS deptName', 'designations.name AS desigName', 'processes.name AS processName')
                    ->whereBetween('login', [$startDateTime, $endDateTime])
                    ->orderBy('attendances.attendance_id', 'asc')
                    ->orderBy('login', 'asc')
                    ->get();

                $arr =array();
                foreach($allUserData as $allUser) {

                    $day = date('D', strtotime($allUser->login));
                    $gmdate = gmdate('H:i:s', (strtotime($allUser->logout) - strtotime($allUser->login)) );
                   
                    $data =  array($allUser->name, $allUser->login, $allUser->logout, $day, $gmdate, $allUser->deptName, $allUser->desigName, $allUser->processName, $allUser->own_status, $allUser->own_remarks, $allUser->super_remarks, $allUser->hr_remarks);
                    array_push($arr, $data);
                }
                
                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Name', 'Login', 'Logout', 'Day', 'H:M:S', 'Department', 'Designation', 'Process', 'Own Status', 'Own Remarks', 'Super Remarks', 'HR Remarks'
                    )

                );

            });

        })->export($type);
    }
}
