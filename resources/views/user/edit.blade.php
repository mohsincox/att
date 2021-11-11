@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-success">
            	<div class="box-header with-border">
                	<h3 class="box-title">User</h3> 
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-edit"></i> Edit Form of <code><b>User</b></code> </h3>
							</div>
							<div class="card-body">

                                {!! Form::model($user, ['url' => "user/$user->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}

                                <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : ''}}">
                                    {!! Form::label('designation_id', 'Designation', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                       {!! Form::select('designation_id', $desigList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Designation']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('designation_id') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
                                    {!! Form::label('department_id', 'Department', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('department_id', $deptList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Department']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('department_id') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('process_id') ? 'has-error' : ''}}">
                                    {!! Form::label('process_id', 'Process', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('process_id', $processList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Process']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('process_id') }}
                                        </span>
                                    </div>
                                </div>
						  		
								<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
                                    {!! Form::label('role', 'Role', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('role', $roleList, null, ['class' => 'form-control', 'placeholder' => 'Select Role', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('role') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
                                    {!! Form::label('status', 'Activity Status', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('status', $activityList, null, ['class' => 'form-control', 'placeholder' => 'Select activityList', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('status') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('sick_leave') ? 'has-error' : ''}}">
                                    {!! Form::label('sick_leave', 'Sick Leave', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('sick_leave', null, ['class' => 'form-control', 'placeholder' => 'Enter Sick Leave', 'autocomplete' => 'off']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('sick_leave') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('casual_leave') ? 'has-error' : ''}}">
                                    {!! Form::label('casual_leave', 'Casual Leave', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('casual_leave', null, ['class' => 'form-control', 'placeholder' => 'Enter Casual Leave', 'autocomplete' => 'off']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('casual_leave') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('annual_leave') ? 'has-error' : ''}}">
                                    {!! Form::label('annual_leave', 'Annual Leave', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('annual_leave', null, ['class' => 'form-control', 'placeholder' => 'Enter Annual Leave', 'autocomplete' => 'off']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('annual_leave') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('joining_date') ? 'has-error' : ''}}">
                                    {!! Form::label('joining_date', 'Joining Date', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('joining_date', null, ['class' => 'form-control', 'placeholder' => 'Enter Joining Date', 'autocomplete' => 'off', 'id' => 'joining_date']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('joining_date') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    
                                    <a href="{{ url('/user') }}" class="btn btn-default">Cancel</a>
                                    
                                    {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#user_update']) !!}
                                    
                                </div>

                                <div class="modal modal-success fade" id="user_update">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title">Confirmation Message</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Want to Update User?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline">Update User</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::close() !!}

							</div>
						</div>
					</div>

            	</div>
      		</div>
    	</div>
  	</div>
</section>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

     <script type="text/javascript">
        $(function () {
            $('.select2').select2()
        })

        $('#joining_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker();
    </script>
@endsection