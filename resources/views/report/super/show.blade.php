@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Supevisor Attendance Information of <code>{{ $process->name }}</code> Process From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <!-- <th>AttID</th>
                                    <th>UserID</th> -->
                                    <th>Name</th>
                                    <th>Login</th>
                                    <th>Logout</th>
                                    <th>Day</th>
                                    <th>H:M:S</th>
                                    <th>Own Status</th>
                                    <th>Own Remarks</th>
                                    <th>Super Remarks</th>
                                    <th>HR Remarks</th>
                                    <th>Add Super</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($superData as $super)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <!-- <td>{{ $super->attId }}</td>
                                    <td>{{ $super->userId }}</td> -->
                                    <td>{{ $super->name }}</td>
                                    <td>{{ $super->login }}</td>
                                    <td>{{ $super->logout }}</td>
                                    <td>{{ date('D', strtotime($super->login)) }}</td>
                                    <td>{{ gmdate('H:i:s', (strtotime($super->logout) - strtotime($super->login)) ) }}</td>
                                    <td>{{ $super->own_status }}</td>
                                    <td>{{ $super->own_remarks }}</td>
                                    <td>{{ $super->super_remarks }}</td>
                                    <td>{{ $super->hr_remarks }}</td>
                                    <td><a href="{{ url('super/attendance/'.$super->attId.'/edit') }}" class="btn btn-success btn-flat btn-xs">Remarks</a></td>
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