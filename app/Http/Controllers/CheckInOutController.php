<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\CheckInOut;
use App\Models\Attendance;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class CheckInOutController extends Controller
{

    public function index()
    {
        $startDateTime = date('Y-m-d') . ' 00:00:00';
        $endDateTime = date('Y-m-d') . ' 23:59:59';

        
        $checkInOuts = CheckInOut::with(['userInfo'])->select('USERID', DB::raw('count(*) as Total'), DB::raw('min("CHECKTIME") as MIN_CHECKTIME'), DB::raw('max("CHECKTIME") as MAX_CHECKTIME') )
                 ->groupBy('USERID')
                 ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
                 ->get();

        $i = 0;
        foreach ($checkInOuts as $key => $value) {
            ++$i;
        }
        echo $i;

    }


    public function form()
    {
        return view('check_in_out.form');
    }

    public function insert(Request $request)
    {

        $startDate = $request->start_date;
        // $endDate = $request->end_date;
        $startDateTime = $request->start_date . ' 00:00:00';
        $endDateTime = $request->start_date . ' 23:59:59';

        
        $checkInOuts = CheckInOut::with(['userInfo'])->select('USERID', DB::raw('count(*) as Total'), DB::raw('min("CHECKTIME") as MIN_CHECKTIME'), DB::raw('max("CHECKTIME") as MAX_CHECKTIME') )
                 ->groupBy('USERID')
                 ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
                 ->get();


        foreach ($checkInOuts as $checkInOut) {
            $attendance = new Attendance;
            $attendance->attendance_id = $checkInOut->userInfo->BADGENUMBER;
            $attendance->login = $checkInOut->MIN_CHECKTIME;
            $attendance->logout = $checkInOut->MAX_CHECKTIME;
            $attendance->logout = $checkInOut->MAX_CHECKTIME;
            $attendance->created_by = Auth::id();
            $attendance->save();
        }

        // return response()->json([
        //     "code" => 200,
        //     "message" => "Check Time added successfully"
        // ]);

        flash()->success(' Data inserted successfully');
        return redirect()->back();
    }

    public function insertYesterday(Request $request)
    {
        $yesterday = date( 'Y-m-d', strtotime( date('Y-m-d') . ' -1 day' ) );
        
        $startDateTime = $yesterday . ' 00:00:00';
        $endDateTime = $yesterday . ' 23:59:59';

        $checkInOuts = CheckInOut::with(['userInfo'])->select('USERID', DB::raw('count(*) as Total'), DB::raw('min("CHECKTIME") as MIN_CHECKTIME'), DB::raw('max("CHECKTIME") as MAX_CHECKTIME') )
                 ->groupBy('USERID')
                 ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
                 ->get();


        foreach ($checkInOuts as $checkInOut) {
            $attendance = new Attendance;
            $attendance->attendance_id = $checkInOut->userInfo->BADGENUMBER;
            $attendance->login = $checkInOut->MIN_CHECKTIME;
            $attendance->logout = $checkInOut->MAX_CHECKTIME;
            $attendance->save();
        }

        return response()->json([
            "code" => 200,
            "message" => "Check Time added successfully"
        ]);

    }

    public function it()
    {
        // $startDateTime = date('Y-m-d') . ' 00:00:00';
        // $endDateTime = date('Y-m-d') . ' 23:59:59';

        // // return $users = User::with(['attendance' => function ($query) use($startDateTime, $endDateTime) {
        // //     $query->whereBetween('login', [$startDateTime, $endDateTime]);
        // // }])->where('department', 'IT')->get();


        // // return $attendances = Attendance::with(['user' => function ($query) {
        // //     $query->where('department', 'IT');
        // // }])->whereBetween('login', [$startDateTime, $endDateTime])->get();


        // return $deptWiseAttends = Attendance::join('users', 'users.attendance_id', '=', 'attendances.attendance_id')
        // // ->select('users.role AS urole', 'attendances.role AS arole' , 'attendances.login')
        // ->where('users.department_id', 2)
        // ->whereBetween('login', [$startDateTime, $endDateTime])->get();

        

                        // $serverName = "192.168.100.68\SQLEXPRESS";
                        $serverName = "192.168.100.68";
                        $connectionInfo = array( "Database"=>"ZKF18","UID"=>"sa", "PWD"=>"myadmin!@#");
                        $conn = sqlsrv_connect( $serverName, $connectionInfo);

                        if( $conn ) {
                    
                                echo "Connection established.<br />";
                            
                             

                    
                        }else{
                             echo "Connection could not be established.<br />";
                             die( print_r( sqlsrv_errors(), true));
                        }
                    

        // phpinfo();
    }
}
