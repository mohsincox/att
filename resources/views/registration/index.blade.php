@extends('layouts.app')

@section('content')
<div class="container">
    <section class="content">
        <div class="row">
        	<div class="col-md-12">
            	<div class="box box-primary">
                	<div class="box-header">
                    	<h3 class="box-title">App Users List</h3> 
                    	<div class="box-tools pull-right">
                    		<a href="{{ url('user-registration/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create App User</a>
                    	</div>
                	</div>
                	<div class="box-body">
                        <div class="table-responsive"> 
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Area/Depot/Mobile</th>
                                        <th>Zone</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                @foreach($regUsers as $regUser)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $regUser->email }}</td>
                                        <td>{{ base64_decode($regUser->secret) }}</td>
                                        <td class="text-capitalize">{{ $regUser->role }}</td>
                                        <td>{{ $regUser->name }}</td>
                                        <td>{{ $regUser->phone_number }}</td>
                                        <td>{{ $regUser->depot_app_user }}</td>
                                        <td>{{ $regUser->zone }}</td>
                                        <td>{!! Html::link("user-registration/$regUser->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
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