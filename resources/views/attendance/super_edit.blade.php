@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-success">
            	<div class="box-header with-border">
                	<h3 class="box-title">Super Remarks</h3> 
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-edit"></i> Edit Form of <code><b>Super Remarks</b></code> </h3>
							</div>
							<div class="card-body">

                                {!! Form::model($attendance, ['url' => "super/attendance/$attendance->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
						  		
								<!-- <div class="form-group {{ $errors->has('attendance_id') ? 'has-error' : ''}}">
                                    {!! Form::label('attendance_id', 'attendance_id', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->attendance_id }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('attendance_id') }}
                                        </span>
                                    </div>
                                </div> -->

                                <div class="form-group {{ $errors->has('login') ? 'has-error' : ''}}">
                                    {!! Form::label('login', 'Login', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->login }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('login') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('logout') ? 'has-error' : ''}}">
                                    {!! Form::label('logout', 'Logout', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->logout }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('logout') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('own_status') ? 'has-error' : ''}}">
                                    {!! Form::label('own_status', 'Own Status', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->own_status }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('own_status') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('own_remarks') ? 'has-error' : ''}}">
                                    {!! Form::label('own_remarks', 'Own Remarks', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->own_remarks }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('own_remarks') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('hr_remarks') ? 'has-error' : ''}}">
                                    {!! Form::label('hr_remarks', 'HR Remarks', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        <p>{{ $attendance->hr_remarks }}</p>
                                        <span class="text-danger">
                                            {{ $errors->first('hr_remarks') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('super_remarks') ? 'has-error' : ''}}">
                                    {!! Form::label('super_remarks', 'Super Remarks', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('super_remarks', null, ['class' => 'form-control', 'placeholder' => 'Super Remarks', 'autocomplete' => 'off']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('super_remarks') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#remarks']) !!}
                                </div>

                                <div class="modal modal-info fade" id="remarks">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title">Confirmation Message</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Want to Add Remarks?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline">Submit to add Remarks</button>
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