@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            	<div class="box box-primary">
                	<div class="box-header">
                    	<h3 class="box-title">HR Leave List</h3> 
                    	<div class="box-tools pull-right">
                    		<!-- <a href="{{ url('leave/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Apply for Leave</a> -->
                    	</div>
                	</div>
                	<div class="box-body">
                        <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Dept</th>
                                        <th>sick</th>
                                        <th>s. taken</th>
                                        <th>casual</th>
                                        <th>c taken</th>
                                        <th>annual</th>
                                        <th>a taken</th>
                                        
                                        <!-- <th>Edit</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                @foreach($leaveData as $leave)
                                    <tr>
                                        <td>{{ $leave->attendance_id }}</td>
                                        <td>{{ $leave->name }}</td>
                                        <td>{{ $leave->department->name }}</td>
                                        <td>{{ $leave->sick_leave }}</td>
                                        <td>{{ $leave->taken_sick_leave }}</td>
                                        <td>{{ $leave->casual_leave }}</td>
                                        <td>{{ $leave->taken_casual_leave }}</td>
                                        <td>{{ $leave->annual_leave }}</td>
                                        <td>{{ $leave->taken_annual_leave }}</td>
                                        
                                        <!-- <td>{!! Html::link("user-ttt/$leave->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td> -->
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

    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js') }}"></script>
    
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );
        $(document).ready(function() {
		    $('#example').DataTable( {
		        dom: 'Bfrtip',
		        buttons: [
		            'copy', 'csv', 'excel', 'pdf', 'print'
		        ]
		        // buttons: [
		        //     'excel'
		        // ]
		    } );
		} );
    </script>
@endsection