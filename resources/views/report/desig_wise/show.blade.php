@extends('layouts.app')

@section('content')
<div class="container-fluid">
<section class="content">
    <div class="row">
    	<div class="col-md-12">
        	<div class="box box-primary">
            	<div class="box-header">
                	<h3 class="box-title">Attendance Information of <b> {{ $designation->name }} (Designation)</b> From <i>{{ $startDate }}</i> To <i>{{ $endDate }}</i></h3> 
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
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 0;
                            ?>
                            @foreach($desigWiseData as $desigWise)
                                <?php
                                    // if ($desigWise->attendance_id == 1044) {
                                    //     $processes = "Dano, Best Electro, Testy Tibet";
                                    // } else if ($desigWise->attendance_id == 1045) {
                                    //     $processes = "Berger, Mahindra";
                                    // } else if ($desigWise->attendance_id == 1046) {
                                    //     $processes = "Trasncom";
                                    // } else if ($desigWise->attendance_id == 1143) {
                                    //     $processes = "Trasncom";
                                    // } else if ($desigWise->attendance_id == 1211) {
                                    //     $processes = "Trasncom";
                                    // } else if ($desigWise->attendance_id == 1261) {
                                    //     $processes = "Coca-Cola";
                                    // } else if ($desigWise->attendance_id == 1261) {
                                    //     $processes = "Coca-Cola";
                                    // } else if ($desigWise->attendance_id == 1262) {
                                    //     $processes = "Coca-Cola";
                                    // } else if ($desigWise->attendance_id == 1263) {
                                    //     $processes = "999";
                                    // } else if ($desigWise->attendance_id == 1295) {
                                    //     $processes = "Coca-Cola";
                                    // } else if ($desigWise->attendance_id == 1157) {
                                    //     $processes = "Sheba";
                                    // } else if ($desigWise->attendance_id == 1159) {
                                    //     $processes = "Sheba";
                                    // } else if ($desigWise->attendance_id == 1162) {
                                    //     $processes = "Sheba";
                                    // } else if ($desigWise->attendance_id == 1086) {
                                    //     $processes = "Mahindra";
                                    // } else if ($desigWise->attendance_id == 1298) {
                                    //     $processes = "Sheba";
                                    // } else if ($desigWise->attendance_id == 1048) {
                                    //     $processes = "Short Camp";
                                    // } else {
                                    //     $processes = "";
                                    // }
                                ?>
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <!-- <td>{{ $desigWise->attId }}</td>
                                    <td>{{ $desigWise->userId }}</td> -->
                                    <td>{{ $desigWise->name }}</td>
                                    <td>{{ $desigWise->login }}</td>
                                    <td>{{ $desigWise->logout }}</td>
                                    <td>{{ date('D', strtotime($desigWise->login)) }}</td>
                                    <td>{{ gmdate('H:i:s' ,(strtotime($desigWise->logout) - strtotime($desigWise->login)) ) }}</td>
                                    <td>{{ $desigWise->own_status }}</td>
                                    <td>{{ $desigWise->own_remarks }}</td>
                                    <td>{{ $desigWise->super_remarks }}</td>
                                    <td>{{ $desigWise->hr_remarks }}</td>
                                    <td><a href="{{ url('attendance/'.$desigWise->attId.'/edit') }}" class="btn btn-primary btn-flat btn-xs">Remarks</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {!! $desigWiseData->render() !!} --}}
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