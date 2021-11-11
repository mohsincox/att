@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-success">
            	<div class="box-header with-border">
                	<h3 class="box-title">Designation Wise Report</h3> 
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-pencil"></i> <code><b>Designation</b></code> Wise Report </h3>
							</div>
							<div class="card-body">
						  		
								
                                {!! Form::open(['url' => 'report/desig-wise-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

                                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
                                    {!! Form::label('start_date', 'Start Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'start_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('start_date') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                                    {!! Form::label('end_date', 'End Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => 'Select Start Date', 'autocomplete' => 'off', 'id' => 'end_date', 'readonly' => 'readonly', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('end_date') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : ''}}">
                                    {!! Form::label('designation_id', 'Designation', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                       {!! Form::select('designation_id', $desigList, null, ['class' => 'form-control select2', 'placeholder' => 'Select Designation', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('designation_id') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="box-footer">
                                    
                                    <!-- <a href="{{ url('/profile') }}" class="btn btn-default">Cancel</a> -->
                                    
                                    {!! Form::submit('Submit', ['class' => 'btn btn-success pull-right']) !!}
                          
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
        var ourDate = new Date();
        var pastDate = ourDate.getDate() - 1;
        ourDate.setDate(pastDate);
        // console.log(ourDate);

        $(function () {
            $('.select2').select2()
        })

        $('#start_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker("setDate", ourDate);

        $('#end_date').datepicker({
            format:'yyyy-mm-dd',
            "autoclose": true
        }).datepicker("setDate", ourDate);
    </script>
@endsection