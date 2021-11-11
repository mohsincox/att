<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Leave;
use App\Models\LeaveDetail;
use DB;

class LeaveReportController extends Controller
{
    public function index()
    {
        // return $leaves = User::where('id', 11)->get();

        $leaveData = User::select("users.*",
                    DB::raw("(SELECT SUM(leaves.total_days_off) FROM leaves
                                WHERE leaves.applicant_id = users.id AND leaves.leave_type = 'Sick Leave' AND leaves.hr_status = 'Approved'
                                GROUP BY leaves.applicant_id) as taken_sick_leave"),
                    DB::raw("(SELECT SUM(leaves.total_days_off) FROM leaves
                                WHERE leaves.applicant_id = users.id AND leaves.leave_type = 'Casual Leave' AND leaves.hr_status = 'Approved'
                                GROUP BY leaves.applicant_id) as taken_casual_leave"),
                    DB::raw("(SELECT SUM(leaves.total_days_off) FROM leaves
                                WHERE leaves.applicant_id = users.id AND leaves.leave_type = 'Annual Leave' AND leaves.hr_status = 'Approved'
                                GROUP BY leaves.applicant_id) as taken_annual_leave")
                )
          	->where('status', 'Active')
          	->whereNotIn('department_id', [8, 9])
          	->get();

          	return view('leave.report_user', compact('leaveData'));
    }
}
