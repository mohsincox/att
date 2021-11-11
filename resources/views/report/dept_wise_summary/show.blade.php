@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">
        	<div class="box box-primary">
            	<div class="box-header">
                	<!-- <h3 class="box-title">Attendance Information of <b> {{ $department->name }} Department</b> From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3>  -->
                	<h3 class="box-title">Attendance Information of <b> {{ $department->name }} Department</b> in <i><b>{{ date("F",strtotime($startDate)) }}</b></i> </h3>
                	<p><b>{{ $fridaysCount }}</b> Fridays, <b>{{ $saturdaysCount }}</b> Saturdays & <b>{{ $day_count }}</b> days of {{ date("F",strtotime($startDate)) . ' ' . date("Y",strtotime($startDate)) }}</p>
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="" class="table table-bordered table-striped">
                            <!-- <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>attID</th>
                                    <th>Name</th>
                                    <th>Overtime</th>
                                </tr>
                            </thead> -->
                            <tbody>
                            <?php
                                $i = 0;
                                $totalLate = 0;
                                $totalOvertime = 0;
                            ?>
                            @foreach($deptUsers as $user)
                                <tr>
                                    <!-- <td>{{ ++$i }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->attendance_id }}</td> -->
                                    <td><a href='{{ url("/report/id-wise-summary-show?start_date=$startDate&end_date=$endDate&attendance_id=$user->attendance_id") }}' target="_blank">Name: <b>{{ $user->name }}</b></a></td>
                                    @foreach($deptWiseAttenData as $atten)
                                    	@if( $user->id == $atten->userId )
                                    		<td>Attend: <b>{{ $atten->total }}</b></td>
                                    	@endif
                                    @endforeach

                                    @foreach($deptWiseAttenData as $atten)
                                        @if( $user->id == $atten->userId )
                                            <td>Absent with Fri: <b>{{ $day_count - $atten->total }}</b></td>
                                        @endif
                                    @endforeach

                                    @foreach($deptWiseAttenData as $atten)
                                        @if( $user->id == $atten->userId )
                                            <td>Absent except Fri: <b style="color: red;">{{ $day_count - ($atten->total + $fridaysCount) }}</b></td>
                                        @endif
                                    @endforeach
                                    
                                    @foreach($deptWiseLateData as $late)
                                    	@if( $user->id == $late->userId )
                                    		<td>Late: <b>{{ $late->total }}</b></td>
                                    		<?php
                                    			$totalLate = $late->total;
                                    		?>
                                    	@endif
                                    @endforeach
                                    
                                    @foreach($deptWiseOvertimeData as $overtime)
                                    	@if( $user->id == $overtime->userId )
                                    		<td>Overtime: <b>{{ $overtime->total }}</b></td>
                                    		<?php
                                    			$totalOvertime = $overtime->total;
                                    		?>
                                    	@endif
                                    @endforeach
                                    <?php
                            			$actualLate = $totalLate - $totalOvertime;
                            			$actualLateNegRemove = ($actualLate > 0 ? $actualLate : 0);
                            		?>
                                    <!-- <td style="color: red;">Actual late: <b>{{ $actualLateNegRemove }}</b></td> -->
                                    
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                        <!-- <table id="" class="display table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>userId</th>
                                    <th>attID</th>
                                    <th>overtime</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($deptWiseOvertimeData as $overtime)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $overtime->userId }}</td>
                                    <td>{{ $overtime->attendanceId }}</td>
                                    <td>{{ $overtime->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table> -->
                       
                    </div>
                    <div>
                        <p><b>Late:</b> Entry in office after <b>09:30</b></p>
                        <p><b>Overtime:</b> Exit from office after <b>19:00</b></p>
                        <p><b>Actual Late:</b> Total Late - Total Overtime </p>
                    </div>
            	</div>
      		</div>
    	</div>
  	</div>
</section>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('table.display').DataTable( {
                "pageLength": 31
            } );
        } );
    </script>
@endsection