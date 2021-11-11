<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Designation;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $designations = Designation::get();
        return view('designation.index', compact('designations'));
    }

    public function create()
    {
        return view('designation.create');
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:designations'
        ];
        $messages = [
            'name.required' => 'The Designation field is required.',
            'name.unique' => 'The Designation already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $designation = new Designation;
        $designation->name = $request->name;
        $designation->created_by = Auth::id();
        $designation->save();
        flash()->success($designation->name.' Designation created successfully');
        return redirect('designation');
    }

    public function edit($id)
    {
        $designation = Designation::find($id);
        return view('designation.edit', compact('designation'));
    }
    
    public function update(Request $request, $id)
    {
        $designation = Designation::find($id);
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:designations,name,'.$designation->id,
            'status' => 'required',
        ];
        $messages = [
            'name.required' => 'The Designation field is required.',
            'name.unique' => 'The Designation already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $designation->name = $request->name;
        $designation->status = $request->status;
        $designation->updated_by = Auth::id();
        $designation->save();
        flash()->success($designation->name.' Designation updated successfully');
        return redirect('designation');
    }
}
