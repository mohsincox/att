<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Process;
use Validator;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$users = User::with(['designation', 'department', 'process'])->where('status', 'Active')->get();
    	return view('user.index', compact('users'));
    }

    public function inactive()
    {
        $users = User::with(['department'])->where('status', 'Inactive')->get();
        return view('user.index', compact('users'));
    }

    public function edit($id)
    {
    	$user = User::find($id);
        //$roleList = ['super_admin' => 'Super Admin', 'admin' => 'Admin', 'supervisor' => 'Supervisor', 'user' => 'User'];
        $roleList = ['admin' => 'Admin', 'supervisor' => 'Supervisor', 'user' => 'User'];
    	$activityList = ['Active' => 'Active', 'Inactive' => 'Inactive'];

        $deptList = Department::pluck('name', 'id');
        $desigList = Designation::pluck('name', 'id');
        $processList = Process::pluck('name', 'id');
    	
    	return view('user.edit', compact('user', 'roleList', 'activityList', 'deptList', 'desigList', 'processList'));
    }

    public function update(Request $request, $id)
    {
    	$user = User::find($id);

        $input = Input::all();
        $rules = [
            'designation_id' => 'required',
            'department_id' => 'required',
            'process_id' => 'required'
        ];
        $messages = [
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
        
        $user->designation_id = $request->designation_id;
        $user->department_id = $request->department_id;
        $user->process_id = $request->process_id;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->sick_leave = $request->sick_leave;
        $user->casual_leave = $request->casual_leave;
        $user->annual_leave = $request->annual_leave;
        if ($request->joining_date != null) {
            $user->joining_date = $request->joining_date;
        }
        $user->updated_by = Auth::id();
        $user->save();
        flash()->success($user->name.' Updated Successfully');
        return redirect('user'); 
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function profile()
    {
        $user = User::find(Auth::id());

        return view('user.profile', compact('user'));
    }

    public function profileEdit()
    {
    	// $profile = User::with(['designation', 'department', 'process'])->find(Auth::id());

    	return view('user.profile_edit');
    }
    
    public function profileUpdate(Request $request)
    {
        $input = Input::all();
        $rules = [
            'email' => 'required|unique:users,email,'.Auth::id(),
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:5000'
        ];
        $messages = [
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

    	$profile = User::find(Auth::id());
        if ($request->image == null) {
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->phone_number = $request->phone_number;
            $profile->address = $request->address;
            $profile->save();

            flash()->success($profile->name.' Profile Updated Successfully');

            return redirect('profile');
        }
        else {
            if (Input::file('image')->isValid()) {
                $destinationPath = public_path('uploads/');
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = date("Y-m-d_H-i-s").'_'.rand(11111, 99999) . '.' . $extension;
                Input::file('image')->move($destinationPath, $fileName);
            } else {
                flash()->error('uploaded file is not valid');

                return redirect()->back()->withInput();
            }
            
            File::delete(public_path('uploads/') . $profile->image);
            $profile->name = $request->name;
            $profile->email = $request->email;
            $profile->phone_number = $request->phone_number;
            $profile->address = $request->address;
            $profile->image = $fileName;
            $profile->save();

            flash()->success($profile->name.' Profile Updated Successfully');

            return redirect('profile');
        }
    }

    public function changePasswordForm()
    {
        return view('user.change_password_form');
    }

    public function changePasswordStore(Request $request)
    {
        $user = Auth::user();
        $rules = array(
            'old_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::action('UserController@changePasswordForm',$user->id)->withErrors($validator);
        }
        else
        {
            if (!Hash::check(Input::get('old_password'), $user->password))
            {
                flash()->error('Old password not matched');

                return redirect()->back();
            }
            else
            {
                $user->password = Hash::make(Input::get('password'));
                $user->secret = base64_encode(Input::get('password'));
                $user->save();

                flash()->success('Password have been changed');

                return redirect('/');
            }
        }
    }
}
