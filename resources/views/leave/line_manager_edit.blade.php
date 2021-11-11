@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12 col-sm-offset-0">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Line Manager Leave Update </h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-edit"></i> Line Manager <code><b>Leave</b></code> Update Form </h3>
    							</div>
                                
    							<div class="card-body">
    						  		
                                    {!! Form::model($leave, ['url' => "line-manager-leave/$leave->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
                                    
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12">
                                            <div class="form-group {{ $errors->has('line_manager_status') ? 'has-error' : ''}}">
                                                {!! Form::label('line_manager_status', 'Line Manager Status', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::select('line_manager_status', ['Approved' => 'Approved', 'Not Approved' => 'Not Approved'], null, ['class' => 'form-control','placeholder' => 'Select Line Manager Status']) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('line_manager_status') }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="form-group {{ $errors->has('remarks_update') ? 'has-error' : ''}}">
                                                {!! Form::label('remarks_update', 'Remarks', ['class' => 'required col-xs-3 col-sm-3 control-label']) !!}
                                                <div class="col-xs-9 col-sm-9">
                                                    {!! Form::textarea('remarks_update', null, ['class' => 'form-control', 'placeholder' => 'Enter Verbatim or Issue', 'autocomplete' => 'off', 'rows' => 3]) !!}
                                                    <span class="text-danger">
                                                        {{ $errors->first('remarks_update') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <!-- <button type="button" class="btn btn-default">Cancel</button> -->
                                        <a href="{{ url('/line-manager-leave') }}" class="btn btn-default">Cancel</a>
                                       
                                         {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#leave_update']) !!}
                                    </div>

                                    <div class="modal modal-warning fade" id="leave_update">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Confirmation Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Want to Update This Leave?</h3>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline">Update Leave</button>
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



                <div class="panel panel-primary">
                            <div class="panel-heading text-center"><code>Leave ID: <b>{{ $leave->id }}</b></code> <code>Leave Day: <b>{{ $leave->total_days_off }}</b></code></div>
                                <div class="panel-body">
                            
                                    <h4><code>Leave ID: <b><a href="{{ url('/ticffffket/' . $leave->id) }}">{{ $leave->id }}</a></b></code></h4> 
                                    <div class="table-responsive">          
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Submission Date</td>
                                                    <td><b>{{ $leave->created_at }}</b></td>
                                                    <td>Employee ID</td>
                                                    <td><b>{{ $leave->applicant->attendance_id }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Name</td>
                                                    <td><b>{{ $leave->applicant->name }}</b></td>
                                                    <td>Designaton</td>
                                                    <td><b>{{ $leave->applicant->designation->name }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Department</td>
                                                    <td><b>{{ $leave->applicant->department->name }}</b></td>
                                                    <td>Process</td>
                                                    <td><b>{{ $leave->applicant->process->name }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Leave periond (From)</td>
                                                    <td><b>{{ $leave->from_date }}</b></td>
                                                     <td>Leave periond (To)</td>
                                                    <td><b>{{ $leave->to_date }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Leave Type</td>
                                                    <td><b>{{ $leave->leave_type }}</b></td>
                                                     <td>Total days off</td>
                                                    <td><b>{{ $leave->total_days_off }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Line Manager</td>
                                                    <td><b>{{ $leave->lineManager->name }}</b></td>
                                                     <td>Line Manager Status</td>
                                                    <td><b>{{ $leave->line_manager_status }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Contact</td>
                                                    <td><b>{{ $leave->contract_during_leave }}</b></td>
                                                    <td>HR Status</td>
                                                    <td><b>{{ $leave->hr_status }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Remarks</td>
                                                    <td colspan="3"><b>{{ $leave->remarks }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Created At</td>
                                                    <td><b>{{ $leave->created_at }}</b></td>
                                                    <td>Updated At</td>
                                                    <td><b>{{ $leave->updated_at }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Created By</td>
                                                    <td><b>{{ $leave->createdBy->name }}</b></td>
                                                    <td>Updated By</td>
                                                    @if(isset($leave->updatedBy->name))
                                                        <td><b>{{ $leave->updatedBy->name }}</b></td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                   

                                    <h4><code>Leave Details</code></h4> 
                                    <div class="table-responsive"> 
                                        <table id="" class="table table-bordered table-striped table-condensed">
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                    <th>Created By</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($leave->leaveDetails as $leaveDetail)
                                            <tr>
                                                <td>{{ $leaveDetail->status }}</td>
                                                <td>{{ $leaveDetail->remarks }}</td>

                                                @if(isset($leaveDetail->createdBy->name))
                                                    <td>{{ $leaveDetail->createdBy->name }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ $leaveDetail->created_at }}</td>

                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    
                                </div>
                            </div>


        	</div>
      	</div>
    </section>
</div>
@endsection

@section('style')
    <style type="text/css">
       
        .panel-heading {
            padding: 0px 15px;
        }
    </style>
@endsection





