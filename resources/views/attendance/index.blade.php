@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Attendance Information </i></h3> 
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Date</th>
                                    <th>Day of week</th>
                                    <th>Leave or Absent</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    @if( (Auth::id() == 11) )
                                    <!-- <th>Own Remarks</th>
                                    <th>S Remarks</th>
                                    <th>Hr Remarks</th> -->
                                    @endif
                                    <!-- <th>Edit</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($attendances as $idWise)
                                <tr>
                                    <td>{{ $idWise->id}}</td>
                                    <td>{{ $idWise->attendance_id }}</td>
                                    <td>{{ $idWise->employee_name }}</td>
                                    <td>{{ $idWise->department_name }}</td>
                                    <td>{{ $idWise->entry_date }}</td>
                                    <td>{{ $idWise->day_of_week }}</td>
                                    <td>{{ $idWise->leave_or_absent }}</td>
                                    <td>{{ $idWise->login }}</td>
                                    <td>{{ $idWise->logout }}</td>
                                    @if( (Auth::id() == 11) )
                                    <!-- <td>{{ $idWise->own_remarks }}</td>
                                    <td>{{ $idWise->super_remarks }}</td>
                                    <td>{{ $idWise->hr_remarks }}</td> -->
                                    @endif
                                    <!-- <td><a href="{{ url('attendance/'.$idWise->id.'/edit') }}" class="btn btn-success btn-flat btn-xs">Remarks</a></td> -->
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $attendances->render() !!}
            	</div>
      		</div>
    	</div>
  	</div>
</section>
</div>
@endsection

