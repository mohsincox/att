@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            	<div class="box box-primary">
                	<div class="box-header">
                    	<h3 class="box-title">Line Manager Leave List</h3> 
                    	<div class="box-tools pull-right">
                    		<!-- <a href="{{ url('leave/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Apply for Leave</a> -->
                    	</div>
                	</div>
                	<div class="box-body">
                        <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>leave_type</th>
                                        <th>from_date</th>
                                        <th>to_date</th>
                                        <th>total_days_off</th>
                                        <th>remarks</th>
                                        <th>line_manager_status</th>
                                        <th>hr_status</th>
                                        <th>Edit</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                @foreach($lineManageLeaves as $leave)
                                    <?php
                                        if ($leave->line_manager_status == 'Approved') {
                                            $bgLineCSS = 'background-color: #008000;';
                                        } else if ($leave->line_manager_status == 'Not Approved') {
                                            $bgLineCSS = 'background-color: #FF0000;';
                                        } else {
                                            $bgLineCSS = '';
                                        }

                                        if ($leave->hr_status == 'Approved') {
                                            $bgHrCSS = 'background-color: #008000;';
                                        } else if ($leave->hr_status == 'Not Approved') {
                                            $bgHrCSS = 'background-color: #FF0000;';
                                        } else {
                                            $bgHrCSS = '';
                                        }
                                    ?>
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $leave->applicant->name }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>{{ $leave->from_date }}</td>
                                        <td>{{ $leave->to_date }}</td>
                                        <td>{{ $leave->total_days_off }}</td>
                                        <td>{{ $leave->remarks }}</td>
                                        <td style="{{ $bgLineCSS }}">{{ $leave->line_manager_status }}</td>
                                        <td style="{{ $bgHrCSS }}">{{ $leave->hr_status }}</td>
                                        <td>{!! Html::link("line-manager-leave/$leave->id/edit",' Approve / Not App.', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
                                        <td>{!! Html::link("leave/$leave->id",' Details', ['class' => 'fa fa-edit btn btn-primary btn-xs btn-flat']) !!}</td>
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
            $('#example').DataTable();
        } );
    </script>
@endsection