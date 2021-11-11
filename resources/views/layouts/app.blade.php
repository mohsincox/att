<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>MYOL</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('assets/css/_all-skins.min.css') }}">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  	<style type="text/css">
        .alert {
            padding: 2px; 
            margin-bottom: 5px;
        }

        .required:after{ 
	        content:'*'; 
	        color:red; 
	        padding-left:5px;
	    }
      .skin-purple .main-header .navbar {
          padding: 10px;
      }
    </style>

     @yield('style')
</head>

<body class="hold-transition skin-purple layout-top-nav">
	<div class="wrapper">
  		<header class="main-header">
    		<nav class="navbar navbar-static-top">
      			<div class="container">

        			<div class="navbar-header">
                  <!-- <a href="{{ url('/') }}" class="navbar-brand"><b>MYOL</b> Attendance</a> -->
          				<!-- <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('assets/images/myol8171.png') }}" height="63" width="63" style="margin-top: -26px;"></a> -->
                  <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('assets/images/myol8171.png') }}" style="margin-top: -26px;"></a>
          				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            				<i class="fa fa-bars"></i>
          				</button>
        			</div>
        			@if (Auth::guest())
			        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
			          	<ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/login') }}"> <i class="fa fa-sign-in"></i> Login <span class="sr-only">(current)</span></a></li> 
			            	<!-- <li class="active"><a href="{{ url('/register') }}"> <i class="fa fa-sign-in"></i> Registration <span class="sr-only">(current)</span></a></li>  -->
			          	</ul>
			        </div>
        			@else
        			<div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          				<ul class="nav navbar-nav">
            				<!-- <li class="active"><a href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a></li> -->
            				<li {{ ( Request::is('user') || Request::is('user/*') ? 'class=active' : '' ) }} ><a href="{{ url('/user') }}">User</a></li>
                    <!-- <li {{ ( Request::is('profile') ? 'class=active' : '' ) }} ><a href="{{ url('/profile') }}">Profile</a></li> -->
            				<li {{ ( Request::is('profile-edit') || Request::is('profile') ? 'class=active' : '' ) }} ><a href="{{ url('/profile-edit') }}">Profile</a></li>
                    @can('admin-access')
                      <li {{ ( Request::is('designation') || Request::is('designation/*') ? 'class=active' : '' ) }} ><a href="{{ url('/designation') }}">Designation</a></li>
                      <li {{ ( Request::is('department') || Request::is('department/*') ? 'class=active' : '' ) }} ><a href="{{ url('/department') }}">Department</a></li>
                      <li {{ ( Request::is('process') || Request::is('process/*') ? 'class=active' : '' ) }} ><a href="{{ url('/process') }}">Process</a></li>
                     <!--  <li {{ ( Request::is('select') || Request::is('select/*') ? 'class=active' : '' ) }} ><a href="{{ url('/select') }}">Select</a></li>
                      <li {{ ( Request::is('option') || Request::is('option/*') ? 'class=active' : '' ) }} ><a href="{{ url('/option') }}">Option</a></li> -->
                      <li {{ ( Request::is('option') || Request::is('option/*') ? 'class=active' : '' ) }} ><a href="{{ url('/option') }}">Status</a></li>
                    @endcan

                    @can('supervisor-access')
                      <li {{ ( Request::is('super-form') || Request::is('super-show') ? 'class=active' : '' ) }} ><a href="{{ url('/super-form') }}">Process Data</a></li>
                    @endcan
                    <!-- <li><a href="{{ url('/attendance-upload-excel') }}">Upload</a></li> -->
                    @if((Auth::id() == 331) || (Auth::id() == 415))
                    <li {{ ( Request::is('emp-form') || Request::is('emp-show') ? 'class=active' : '' ) }} ><a href="{{ url('/emp-form') }}">Employee Data</a></li>
                    @endif
                    <li {{ ( Request::is('own-form') || Request::is('own-show') ? 'class=active' : '' ) }} ><a href="{{ url('/own-form') }}">Own Data</a></li>
                    
                    <li {{ ( Request::is('report') || Request::is('report/*') ? 'class=active' : '' ) }} class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/report/dept-wise-summary-form') }}">Summary Report</a></li>
                        <li><a href="{{ url('/report/id-wise-form') }}">ID Wise Report</a></li>
                        <li><a href="{{ url('/report/dept-wise-form') }}">Department Wise Report</a></li>
                        <li><a href="{{ url('/report/desig-wise-form') }}">Designation Wise Report</a></li>
                        <li><a href="{{ url('/report/process-wise-form') }}">Process Wise Report</a></li>
                        <li><a href="{{ url('/report/all-user-form') }}">All Users Report</a></li>
                        <li class="divider"></li>
                        <li class="bg-danger"><a href="#">Report Download</a></li>
                        <li class="divider"></li>
                        <!-- <li><a href="{{ url('/report/id-wise-form-excel') }}">ID Wise Report</a></li>
                        <li><a href="{{ url('/report/dept-wise-form-excel') }}">Department Wise Report</a></li> -->
                        <li><a href="{{ url('/report/all-user-form-excel') }}">All User Report</a></li>
                      </ul>
                    </li>

                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Leave <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/leave') }}">Own Leave</a></li>
                        <li><a href="{{ url('/line-manager-leave') }}">Line Manager Leave</a></li>
                        <li><a href="{{ url('/hr-leave') }}">HR Leave</a></li>
                        <li><a href="{{ url('/leave-report') }}">Leave Report</a></li>
                      </ul>
                    </li>
                    <!-- <li><a href="{{ url('/ex') }}">Excel</a></li> -->
            				<!-- <li {{ ( Request::is('change-password-form') ? 'class=active' : '' ) }} ><a href="{{ url('/change-password-form') }}">Change Password</a></li> -->
            				<li class="dropdown user user-menu">
              					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          @if(isset(Auth::user()->image))
                              <img src="{{ asset('public/uploads/'.Auth::user()->image) }}" class="user-image" alt="User Image">
                          @else
                              <img src="{{ asset('assets/images/user.png') }}" class="user-image" alt="User Image">
                          @endif
                					<!-- <img src="{{ asset('assets/images/user.png') }}" class="user-image" alt="User Image"> -->
                					<span class="hidden-xs">{{ Auth::user()->name }}</span>
              					</a>
              					<ul class="dropdown-menu">
                					<li class="user-header">
                              @if(isset(Auth::user()->image))
                                <img src="{{ asset('public/uploads/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
                              @else
                                  <img src="{{ asset('assets/images/user.png') }}" class="img-circle" alt="User Image">
                              @endif
	                  					
	                  					<p>
	                    					{{ Auth::user()->name }}
	                  					</p>
                					</li>
					                <li class="user-footer">
					                  <div class="pull-left">
                              <a href="{{ url('/logout') }}" class="btn btn-danger btn-flat">Sign out</a>
					                  </div>
					                  <div class="pull-right">
					                    <a href="{{ url('/change-password-form') }}" class="btn btn-warning btn-flat">Change Password</a>
					                  </div>
					                </li>
              					</ul>
            				</li>
          				</ul>
        			</div>
         			@endif
      			</div>
    		</nav>
  		</header>

  		

  		<div class="content-wrapper">
  			<div class="container">
		        <div class="col-sm-8 col-sm-offset-2">
		            @include('flash::message')
		        </div>
		    </div>

    		<!-- <div class="container"> -->
       		@yield('content')
    		<!-- </div> -->
  		</div>
  
 		<footer class="main-footer">
    		<div class="container">
      			<div class="pull-right hidden-xs">
        			<b>Version</b> 1.0
      			</div>
      			<strong>Copyright &copy; {{ date('Y') }} <a href="http://myolbd.com" target="_blank">MY Outsourcing Limited</a>.</strong> All rights reserved.
    		</div>
  		</footer>
	</div>

	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('assets/js/fastclick.js') }}"></script>
	<script src="{{ asset('assets/js/script.min.js') }}"></script>
	<script src="{{ asset('assets/js/demo.js') }}"></script>
	@yield('script')
</body>
</html>
