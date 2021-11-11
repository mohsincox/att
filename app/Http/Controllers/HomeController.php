<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Process;
use App\Models\CheckInOut;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startDateTime = date('Y-m-d') . ' 00:00:00';
        $endDateTime = date('Y-m-d') . ' 23:59:59';

        $todayUniqueLog = CheckInOut::distinct('USERID')->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])->count('USERID');

        $firstCHECKTIME = CheckInOut::join('USERINFO', 'USERINFO.USERID', '=', 'CHECKINOUT.USERID')
            ->where('USERINFO.BADGENUMBER', Auth::user()->attendance_id)
            ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
            ->orderBy('CHECKTIME', 'asc')
            ->first();

        $lastCHECKTIME = CheckInOut::join('USERINFO', 'USERINFO.USERID', '=', 'CHECKINOUT.USERID')
            ->where('USERINFO.BADGENUMBER', Auth::user()->attendance_id)
            ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
            ->orderBy('CHECKTIME', 'desc')
            ->first();

        $startYesterday = date('Y-m-d', strtotime('-1 day')) . ' 00:00:00';
        $endYesterday = date('Y-m-d', strtotime('-1 day')) . ' 23:59:59';

        $firstYestrday = Attendance::where('attendance_id', Auth::user()->attendance_id)
            ->whereBetween('login', [$startYesterday, $endYesterday])
            ->orderBy('login', 'asc')
            ->first();

        $lastYestrday = Attendance::where('attendance_id', Auth::user()->attendance_id)
            ->whereBetween('logout', [$startYesterday, $endYesterday])
            ->orderBy('logout', 'desc')
            ->first();

        $userCount = User::where('status', 'Active')->count();
        $deptCount = Department::count();
        $desigCount = Designation::count();
        $processCount = Process::count();
        // $attenCount = Attendance::count();
        $attenMonthCount = Attendance::where('attendance_id', Auth::user()->attendance_id)->whereBetween('login', [date('Y-m-01'), date('Y-m-d')])->count();

        if(isset($firstCHECKTIME)) {
            $attenMonthCount += 1;
        }

        $lateCount = Attendance::where('attendance_id', Auth::user()->attendance_id)->whereTime('login', '>', '09:30:00')->whereBetween('login', [date('Y-m-01'), date('Y-m-d')])->count();

        $lateCHECKTIME = CheckInOut::join('USERINFO', 'USERINFO.USERID', '=', 'CHECKINOUT.USERID')
            ->where('USERINFO.BADGENUMBER', Auth::user()->attendance_id)
            ->where('CHECKTIME', '>', date('Y-m-d') . ' 09:30:00')
            ->whereBetween('CHECKTIME', [$startDateTime, $endDateTime])
            ->orderBy('CHECKTIME', 'asc')
            ->first();
        if(isset($lateCHECKTIME)) {
            $lateCount += 1;
        }

        return view('home', compact('userCount', 'deptCount', 'desigCount', 'processCount', 'attenMonthCount', 'firstCHECKTIME', 'lastCHECKTIME', 'firstYestrday', 'lastYestrday', 'todayUniqueLog', 'lateCount'));
    }

}
