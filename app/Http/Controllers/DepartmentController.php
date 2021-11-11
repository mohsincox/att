<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Department;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Department::get();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:departments'
        ];
        $messages = [
            'name.required' => 'The Department field is required.',
            'name.unique' => 'The Department already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $department = new Department;
        $department->name = $request->name;
        $department->created_by = Auth::id();
        $department->save();
        flash()->success($department->name.' Department created successfully');
        return redirect('department');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit', compact('department'));
    }
    
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:departments,name,'.$department->id,
            'status' => 'required',
        ];
        $messages = [
            'name.required' => 'The Department field is required.',
            'name.unique' => 'The Department already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $department->name = $request->name;
        $department->status = $request->status;
        $department->updated_by = Auth::id();
        $department->save();
        flash()->success($department->name.' Department updated successfully');
        return redirect('department');
    }
}
