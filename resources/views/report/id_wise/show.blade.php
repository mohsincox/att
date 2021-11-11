@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Attendance Information of <b>@if(isset($idWiseData[0])) {{ $idWiseData[0]->employee_name }}@endif {{ '('.$attenId.')' }}</b>  From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <!-- <th>ID</th> -->
                                    <th>Name</th>
                                    <!-- <th>Designation</th>
                                    <th>Department</th>
                                    <th>Process</th> -->
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Day</th>
                                    <th>H:M:S</th>
                                    <th>Own Remarks</th>
                                    <th>Super Remarks</th>
                                    <th>HR Remarks</th>
                                    <th>HR Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($idWiseData as $idWise)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <!-- <td>{{ $idWise->attendance_id }}</td> -->
                                    <td>{{ $idWise->user->name }}</td>
                                    <!-- @if(isset($idWise->user->designation->name))
                                        <td>{{ $idWise->user->designation->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($idWise->user->department->name))
                                        <td>{{ $idWise->user->department->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($idWise->user->process->name))
                                        <td>{{ $idWise->user->process->name }}</td>
                                    @else
                                        <td></td>
                                    @endif -->
                                    <td>{{ $idWise->login }}</td>
                                    <td>{{ $idWise->logout }}</td>
                                    <td>{{ date('D', strtotime($idWise->login)) }}</td>
                                    <td>{{ gmdate('H:i:s' ,(strtotime($idWise->logout) - strtotime($idWise->login)) ) }}</td>
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