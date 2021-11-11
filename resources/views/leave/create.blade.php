@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-8 col-sm-offset-2">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Leave Application Form</h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-pencil"></i> Application Form of <code><b>Leave</b></code> </h3>
    							</div>
    							<div class="card-body">

                                    {!! Form::open(['url' => 'leave', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                                    <div class="form-group {{ $errors->has('line_manager_id') ? 'has-error' : ''}}">
                                        {!! Form::label('line_manager_id', 'Line Manager', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                           {!! Form::select('line_manager_id', $lineManagerList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Line Manager']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('line_manager_id') }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group {{ $errors->has('leave_type') ? 'has-error' : ''}}">
                                        {!! Form::label('leave_type', 'Leave Type', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::select('leave_type', ['Sick Leave' => 'Sick Leave', 'Casual Leave' => 'Casual Leave', 'Annual Leave' => 'Annual Leave'], null, ['class' => 'select2 form-control', 'placeholder' => 'Select Leave Type']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('leave_type') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('from_date') ? 'has-error' : ''}}">
                                        {!! Form::label('from_date', 'From Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('from_date', null, ['class' => 'form-control', 'placeholder' => 'Enter From Date', 'autocomplete' => 'off', 'id' => 'from_date', 'readonly' => 'readonly']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('from_date') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('to_date') ? 'has-error' : ''}}">
                                        {!! Form::label('to_date', 'To Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('to_date', null, ['class' => 'form-control', 'placeholder' => 'Enter To Date', 'autocomplete' => 'off', 'id' => 'to_date', 'readonly' => 'readonly']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('to_date') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('total_days_off') ? 'has-error' : ''}}">
                                        {!! Form::label('total_days_off', 'Total days off', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('total_days_off', null, ['class' => 'form-control', 'placeholder' => 'Enter Total days off', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('total_days_off') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('contract_during_leave') ? 'has-error' : ''}}">
                                        {!! Form::label('contract_during_leave', 'Contract during leave', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::text('contract_during_leave', null, ['class' => 'form-control', 'placeholder' => 'Enter Contract person name, relation and number during leave', 'autocomplete' => 'off']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('remarks') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : ''}}">
                                        {!! Form::label('remarks', 'Remarks', ['class' => 'col-3 col-sm-3 control-label']) !!}
                                        <div class="col-xs-9 col-sm-9">
                                            {!! Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder' => 'Enter Remarks', 'autocomplete' => 'off', 'rows' => '3']) !!}
                                            <span class="text-danger">
                                                {{ $errors->first('remarks') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <a href="{{ url('/leave') }}" class="btn btn-default">Cancel</a>
                                        {!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#leave_create']) !!}
                                    </div>

                                    <div class="modal modal-info fade" id="leave_create">
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

        $('#from_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker();

        $('#to_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker();

    </script>
@endsection