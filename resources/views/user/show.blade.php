@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">

    <div class="row">
        <div class="col-md-offset-2 col-md-8">

          	<div class="box box-primary">
            	<div class="box-body box-profile">
                  @if(isset($user->image))
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('public/uploads/'.$user->image) }}" alt="User profile picture">
                  @else
                      <img class="profile-user-img img-responsive img-circle" src="{{ asset('assets/images/user.png') }}" alt="User profile picture">
                  @endif
              		

              		<h3 class="profile-username text-center">{{ $user->name }}</h3>

              		<p class="text-muted text-center">@if(isset($user->designation->name)) {{ $user->designation->name }} @endif</p>

              		<ul class="list-group list-group-unbordered">
                		<li class="list-group-item">
                  			<b>Name</b> <a class="pull-right">{{ $user->name }}</a>
                		</li>
                    @can('admin-access')
                  		<li class="list-group-item">
                    			<b>Email</b> <a class="pull-right">{{ $user->email }}</a>
                  		</li>
                    @endcan
                		<li class="list-group-item">
                  			<b>Activity Status</b> <a class="pull-right">{{ $user->status }}</a>
                		</li>
                		<li class="list-group-item">
                  			<b>Role</b> <a class="pull-right">{{ $user->role }}</a>
                		</li>
                		<li class="list-group-item">
                  			<b>Attendance ID</b> <a class="pull-right">{{ $user->attendance_id }}</a>
                		</li>
                		<li class="list-group-item">
                  			<b>Designation</b> <a class="pull-right">@if(isset($user->designation->name)) {{ $user->designation->name }} @endif</a>
                		</li>
                		<li class="list-group-item">
                  			<b>Department</b> <a class="pull-right">@if(isset($user->department->name)) {{ $user->department->name }} @endif</a>
                		</li>
                    <li class="list-group-item">
                        <b>Process</b> <a class="pull-right">@if(isset($user->process->name)) {{ $user->process->name }} @endif</a>
                    </li>
                    @can('admin-access')
                  		<li class="list-group-item">
                    			<b>Phone Number</b> <a class="pull-right">{{ $user->phone_number }}</a>
                  		</li>
                    @endcan
                		<li class="list-group-item">
                  			<b>Address</b> <a class="pull-right">{{ $user->address }}</a>
                		</li>
              		</ul>

              		<!-- <div class="box-header with-border">
              			<h3 class="box-title">About Me</h3>
            		</div>
              		<center><strong><i class="fa fa-book margin-r-5"></i> Name</strong></center>
              		<center><p>
                		{{ Auth::user()->name }}
              		</p></center>
              		<hr>
              		<strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>
              		<p>{{ Auth::user()->email }}</p>
              		<hr>
              		<center><strong><i class="fa fa-pencil margin-r-5"></i> Activity Status</strong></center>
	              	<center><p>
	                	<span class="label label-success">{{ Auth::user()->status }}</span>
	              	</p></center>
              		<hr>
              		<strong><i class="fa fa-file-text-o margin-r-5"></i> Role</strong>
              		<p class="text-muted">{{ Auth::user()->role }}</p>
              		<hr>
              		<center><strong><i class="fa fa-book margin-r-5"></i> Attendance ID</strong></center>
              		<center><p>
                		{{ Auth::user()->attendance_id }}
              		</p></center>
              		<hr>
              		<strong><i class="fa fa-map-marker margin-r-5"></i> Designation</strong>
              		<p>{{ Auth::user()->designation }}</p>
              		<hr>
              		<center><strong><i class="fa fa-pencil margin-r-5"></i> Department</strong></center>
	              	<center><p>
	                	<span class="label label-success">{{ Auth::user()->department }}</span>
	              	</p></center>
              		<hr>
              		<strong><i class="fa fa-file-text-o margin-r-5"></i> Phone Number</strong>
              		<p>{{ Auth::user()->phone_number }}</p>
              		<hr>
              		<center><strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong></center>
              		<center><p>
                		{{ Auth::user()->address }}
              		</p></center>
              		<hr> -->

            	</div>
          	</div>

        </div>
    </div>

</section>
</div>
@endsection
