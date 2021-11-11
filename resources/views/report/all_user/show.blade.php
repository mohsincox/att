@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Attendance Information of <b> all users</b> From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
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
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Process</th>
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
                            @foreach($allUserData as $allUser)
                                <?php
                                   
                                ?>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <!-- <td>{{ $allUser->attId }}</td>
                                    <td>{{ $allUser->userId }}</td> -->
                                    <td>{{ $allUser->name }}</td>
                                    <td>{{ $allUser->login }}</td>
                                    <td>{{ $allUser->logout }}</td>
                                     <td>{{ date('D', strtotime($allUser->login)) }}</td>
                                    <td>{{ gmdate('H:i:s', (strtotime($allUser->logout) - strtotime($allUser->login)) ) }}</td>
                                    <td>{{ $allUser->deptName }}</td>
                                    <td>{{ $allUser->desigName }}</td>
                                    <td>{{ $allUser->processName }}</td>
                                    <td>{{ $allUser->own_status }}</td>
                                    <td>{{ $allUser->own_remarks }}</td>
                                    <td>{{ $allUser->super_remarks }}</td>
                                    <td>{{ $allUser->hr_remarks }}</td>
                                    <td><a href="{{ url('attendance/'.$allUser->attId.'/edit') }}" class="btn btn-primary btn-flat btn-xs">Remarks</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $processWiseData->render() !!} --}}
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