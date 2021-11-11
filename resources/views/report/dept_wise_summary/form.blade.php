@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-success">
            	<div class="box-header with-border">
                	<h3 class="box-title">Department Wise Summary Report</h3> 
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-pencil"></i> <code><b>Department</b></code> Wise Summary Report </h3>
							</div>
							<div class="card-body">
						  		
								
                                {!! Form::open(['url' => 'report/dept-wise-summary-show', 'method' => 'get', 'class' => 'form-horizontal']) !!}

                                
                                <div class="form-group {{ $errors->has('month') ? 'has-error' : ''}}">
                                    {!! Form::label('month', 'End Date', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::text('month', null, ['class' => 'form-control', 'placeholder' => 'Select Month', 'autocomplete' => 'off', 'id' => 'month', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('month') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
                                    {!! Form::label('department_id', 'Department', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                       {!! Form::select('department_id', $deptList, null, ['class' => 'form-control select2', 'placeholder' => 'Select Department', 'required' => 'required']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('department_id') }}
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
        $(function () {
            $('.select2').select2()
        })

        $("#month").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months",
            "autoclose": true
        });
    </script>
@endsection