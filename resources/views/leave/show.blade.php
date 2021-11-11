@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12 col-sm-offset-0">
            	<div class="box box-success">
                	<div class="box-header with-border">
                    	<h3 class="box-title">Leave Details </h3> 
                	</div>
                	<div class="box-body">

                		<div class="col-sm-12">
    						
    						<div class="card">
    							<div class="card-header">
    								<h3 class="text-center"><i class="fa fa-edit"></i> <code><b>Leave</b></code> Details </h3>
    							</div>
                                
    							<div class="card-body">

    						  		
    								<!-- <h4><code>Leave ID: <b><a href="#">{{ $leave->id }}</a></b></code></h4>  -->
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
          		</div>



               <!--  <div class="panel panel-primary">
                            <div class="panel-heading text-center"><code>Leave ID: <b>{{ $leave->id }}</b></code> <code>Leave Day: <b>{{ $leave->total_days_off }}</b></code></div>
                                <div class="panel-body">
                            
                                    

                                    
                                </div>
                            </div> -->


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





