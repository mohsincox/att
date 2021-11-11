@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">My Attendance Information From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <!-- <th>Designation</th>
                                    <th>Department</th>
                                    <th>Process</th> -->
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Day</th>
                                    <th>H:M:S</th>
                                    <th>Status</th>
                                    <th>Own Remarks</th>
                                    <th>Super Remarks</th>
                                    <th>HR Remarks</th>
                                    <th>Add Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($ownData as $own)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $own->attendance_id }}</td>
                                    <td>{{ $own->user->name }}</td>
                                    <!-- @if(isset($own->user->designation->name))
                                        <td>{{ $own->user->designation->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($own->user->department->name))
                                        <td>{{ $own->user->department->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($own->user->process->name))
                                        <td>{{ $own->user->process->name }}</td>
                                    @else
                                        <td></td>
                                    @endif -->
                                    <td>{{ $own->login }}</td>
                                    <td>{{ $own->logout }}</td>
                                    <td>{{ date('D', strtotime($own->login)) }}</td>
                                    <td>{{ gmdate('H:i:s' ,(strtotime($own->logout) - strtotime($own->login)) ) }}</td>
                                    <td>{{ $own->own_status }}</td>
                                    <td>{{ $own->own_remarks }}</td>
                                    <td>{{ $own->super_remarks }}</td>
                                    <td>{{ $own->hr_remarks }}</td>
                                    <td><a href="{{ url('own/attendance/'.$own->id.'/edit') }}" class="btn btn-success btn-flat btn-xs">Add Issue</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $ownData->render() !!} --}}
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