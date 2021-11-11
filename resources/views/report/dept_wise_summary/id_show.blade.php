@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Attendance Information of <b>@if(isset($idWiseData[0])) {{ $idWiseData[0]->employee_name }}@endif {{ '('.$attenId.')' }}</b>  From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
                	<p class="text-center">Office Time Start:<b><code>9:30:00</code></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Office Time End:<b><code>18:00:00</code></b></p>
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Day</th>
                                    <th>H:M:S</th>
                                    <th>Late</th>
                                    <th>OverTime</th>
                                    <th>ExtraDuty</th>
                                    <th>Own Status</th>
                                    <th>Own Remarks</th>
                                    <th>Super Remarks</th>
                                    <th>HR Remarks</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($idWiseData as $idWise)
                            	<?php
                                    $officeEntryTime = strtotime(date("Y-m-d", strtotime($idWise->login)) . ' 9:30:00');
                                    $officeExitTime = strtotime(date("Y-m-d", strtotime($idWise->logout)) . ' 18:00:00');

                                    $empEntryTime = strtotime(date('Y-m-d H:i:s', strtotime($idWise->login)));
                                    $empExitTime = strtotime(date('Y-m-d H:i:s', strtotime($idWise->logout)));

                                    if ($empEntryTime > $officeEntryTime) {
                                        $l = $empEntryTime - $officeEntryTime;
                                        $late = gmdate('H:i:s', $l);
                                    } else {
                                        $late = '';
                                    }

                                    if ($empExitTime > $officeExitTime) {
                                        $o = $empExitTime - $officeExitTime;
                                        $overtime = gmdate('H:i:s', $o);
                                    } else {
                                        $overtime = '';
                                    }

                                    $extraTime = (strtotime($idWise->logout) - strtotime($idWise->login)) - 30600;

                                    if ($extraTime >= 0) {
                                        $extraDuty = gmdate('H:i:s',$extraTime);
                                    } else {
                                        $extraDuty = '';
                                    }
                                ?>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $idWise->user->name }}</td>
                                    <!-- <td>{{ date("H:i:s d-m-Y", strtotime($idWise->login)) }}</td>
                                    <td>{{ date("H:i:s d-m-Y", strtotime($idWise->logout)) }}</td> -->
                                    <td>{{ $idWise->login }}</td>
                                    <td>{{ $idWise->logout }}</td>
                                    <td>{{ date('D', strtotime($idWise->login)) }}</td>
                                    <td>{{ gmdate('H:i:s', (strtotime($idWise->logout) - strtotime($idWise->login)) ) }}</td>
                                    <td style="color: red;">{{ $late }}</td>
                                    <td>{{ $overtime }}</td>
                                    <td>{{ $extraDuty }}</td>
                                    <td>{{ $idWise->own_status }}</td>
                                    <td>{{ $idWise->own_remarks }}</td>
                                    <td>{{ $idWise->super_remarks }}</td>
                                    <td>{{ $idWise->hr_remarks }}</td>
                                    <td><a href="{{ url('attendance/'.$idWise->id.'/edit') }}" class="btn btn-primary btn-flat btn-xs">Remarks</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $idWiseData->render() !!} --}}
                    </div>
                    <div>
                        <p><b>Late</b> count after <b>09:30:00</b></p>
                        <p><b>Overtime</b> count after <b>18:00:00</b></p>
                        <p><b>Extra Duty</b> count <b>Total Duty Time - Office Duty Time</b></p>
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
            $('#example').DataTable( {
                "pageLength": 31
            } );
        } );
    </script>
@endsection