@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Process List</h3> 
                	<div class="box-tools pull-right">
                		<a href="{{ url('process/create') }}" class="btn btn-primary btn-flat"> <i class="fa fa-plus"></i> Create Process</a>
                	</div>
            	</div>
            	<div class="box-body">
                    <div class="table-responsive"> 
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <!-- <th>ID</th> -->
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($processes as $process)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <!-- <td><b>{{ $process->id }}</b></td> -->
                                    <td>{{ $process->name }}</td>
                                    <td>{{ $process->status }}</td>
                                    <td>{!! Html::link("process/$process->id/edit",' Edit', ['class' => 'fa fa-edit btn btn-success btn-xs btn-flat']) !!}</td>
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
        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );
        $(document).ready(function() {
            $('#example').DataTable( {
                "pageLength": 50
            } );
        } );
    </script>
@endsection