<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Process;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UserRegistrationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
        $deptList = Department::pluck('name', 'id');
        $desigList = Designation::pluck('name', 'id');
        $processList = Process::pluck('name', 'id');

    	return view('registration.create', compact('deptList', 'desigList', 'processList'));
    }

    public function store(Request $request)
    {
    	$input = Input::all();
	    $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'attendance_id' => 'required|numeric|unique:users',
            'designation_id' => 'required',
            'department_id' => 'required',
            'process_id' => 'required',
            'sick_leave' => 'numeric',
            'casual_leave' => 'numeric',
            'annual_leave' => 'numeric',
	    ];
	    $messages = [
            'email.required' => 'The Username field is required.',
            'email.unique' => 'The Username already exist.',
            'name.required' => 'The Name field is required.',
            'attendance_id.required' => 'The Attendance ID field is required.',
            'attendance_id.unique' => 'The Attendance ID already exist.',
            'designation_id.required' => 'The Designation field is required.',
            'department_id.required' => 'The Department field is required.',
            'process_id.required' => 'The Process field is required.',
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
        	flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $regUser = new User;
        $regUser->email = $request->email;
        $regUser->password = bcrypt($request->password);
        $regUser->secret = base64_encode($request->password);
        $regUser->name = $request->name;
        $regUser->attendance_id = $request->attendance_id;
        $regUser->designation_id = $request->designation_id;
        $regUser->department_id = $request->department_id;
        $regUser->process_id = $request->process_id;
        $regUser->sick_leave = $request->sick_leave;
        $regUser->casual_leave = $request->casual_leave;
        $regUser->annual_leave = $request->annual_leave;
        if ($request->joining_date != null) {
            $regUser->joining_date = $request->joining_date;
        }
        
        $regUser->created_by = Auth::id();
        $regUser->save();
        flash()->success($regUser->name.' User registration created successfully');
    	return redirect('user');
    }
}
