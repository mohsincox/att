<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Process;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $processes = Process::orderBy('name', 'asc')->get();
        return view('process.index', compact('processes'));
    }

    public function create()
    {
        return view('process.create');
    }

    public function store(Request $request)
    {
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:processes'
        ];
        $messages = [
            'name.required' => 'The Process field is required.',
            'name.unique' => 'The Process already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $process = new Process;
        $process->name = $request->name;
        $process->created_by = Auth::id();
        $process->save();
        flash()->success($process->name.' Process created successfully');
        return redirect('process');
    }

    public function edit($id)
    {
        $process = Process::find($id);
        return view('process.edit', compact('process'));
    }
    
    public function update(Request $request, $id)
    {
        $process = Process::find($id);
        $input = Input::all();
        $rules = [
            'name' => 'required|unique:processes,name,'.$process->id,
            'status' => 'required',
        ];
        $messages = [
            'name.required' => 'The Process field is required.',
            'name.unique' => 'The Process already exist.'
        ];
        
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            flash()->error('Something Wrong!');
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $process->name = $request->name;
        $process->status = $request->status;
        $process->updated_by = Auth::id();
        $process->save();
        flash()->success($process->name.' Process updated successfully');
        return redirect('process');
    }
}
