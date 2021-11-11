@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">User List</h3> 
                	<div class="box-tools pull-right">
                		<a href="{{ url('user-registration') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> User Registration</a>
                		<!-- <a href="{{ url('user/inactive') }}" class="btn btn-primary btn-flat"> <i class="fa fa-refresh"></i> Deleted Users</a> -->
                	</div>
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
									<th>Name</th>
									@can('admin-access')
										<th>Email</th>
									@endcan
									<th>Designation</th>
									<th>Department</th>
									<th>Process</th>
									@can('admin-access')
										<th>Phone Number</th>
										<th>Address</th>
									@endcan	
									<th>Image</th>
									<th>Details</th>
									<th>Activity</th>
									@if( (Auth::id() == 11) || (Auth::id() == 18) )
									<th>SL</th>
									@endif
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($users as $user)
								<?php
									if ($user->role == 'super_admin') {
										$role = "Super Admin";
									} else if ($user->role == 'admin') {
										$role = "Admin";
									} else if ($user->role == 'supervisor') {
										$role = "Supervisor";
									}else {
										$role = "User";
									}
								?>	
								<tr>
									<td><b>{{ $user->attendance_id }}</b></td>
									<td>{{ $user->name }}</td>
									@can('admin-access')
										<td>{{ $user->email }}</td>
									@endcan
									<!-- <td>{{ $role }}</td> -->
									@if(isset($user->designation->name))
                                        <td>{{ $user->designation->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
									@if(isset($user->department->name))
                                        <td>{{ $user->department->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if(isset($user->process->name))
                                        <td>{{ $user->process->name }}</td>
                                    @else
                                        <td></td>
                                    @endif
									@can('admin-access')
										<td>{{ $user->phone_number }}</td>
										<td>{{ $user->address }}</td>
									@endcan
									@if($user->image == null)
	                                    <td>{{ Html::image('/assets/images/user.png', 'No Picture', ['width' => 50, 'height' => 50]) }}</td>
	                                @else
	                                    <td>{{ Html::image('/public/uploads/' . $user->image, 'No Picture', ['width' => 50, 'height' => 50]) }}</td>
	                                @endif
	                                <!-- <td><a href='{{"user/$user->id"}}' class="btn btn-info btn-sm btn-flat">Details</a></td>
									<td><a href='{{"user/$user->id/edit"}}' class="btn btn-success btn-sm btn-flat">Change</a></td> -->
									<td>{!! Html::link("user/$user->id",' Details', ['class' => 'fa fa-edit btn btn-info btn-xs btn-flat']) !!}</td>
									<td>{!! Html::link("user/$user->id/edit",' Change', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
									@if( (Auth::id() == 11) || (Auth::id() == 18) )
									<td>{{ $user->id }}</td>
									@endif
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
                "pageLength": 20
            } );
        } );
    </script>
@endsection