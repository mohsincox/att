@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">User Registration</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-pencil"></i> Registration Form of <code><b>User</b></code> </h3>
    							</div>
    							<div class="card-body">

                                    {!! Form::open(['url' => 'user-registration', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                        {!! Form::label('name', 'Name', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('name') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                        {!! Form::label('email', 'Email', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('email') }}
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                        {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('password') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('attendance_id') ? 'has-error' : ''}}">
                                        {!! Form::label('attendance_id', 'Attendance ID', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('attendance_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Attendance ID', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('attendance_id') }}
                                            </span>
                                        </div>
                                    </div>

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
                                        <a href="{{ url('/user-registration') }}" class="btn btn-default">Cancel</a>
                                        {!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#user_create']) !!}
                                    </div>

                                    <div class="modal modal-info fade" id="user_create">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Confirmation Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Want to Create User?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline">Create User</button>
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
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">

        $('#joining_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker();

    </script>
@endsection