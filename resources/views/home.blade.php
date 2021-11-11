@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">

    <div class="box box-default">
        <div class="box-header with-border">
            <!-- <h3 class="box-title"><marquee>Eid Mubarak</marquee></h3> -->
            <marquee class="box-title">Notice Board:</marquee>
        </div>
        <div class="box-body" style="background-color: #b0ecf9">
            

					<div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 35px;">{{ date("h:i") }}</span></center>
                                    <center><span class="info-box-number" style="font-size: 18px;">{{ date("m/d/Y") }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Users</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $userCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><i class="fa fa-phone"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Today's User</span></center>
                                    <center><span class="info-box-number blink_me" style="font-size: 35px;">{{ $todayUniqueLog }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-hand-o-right"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Department</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $deptCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-bullhorn"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Designation</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $desigCount }}</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-tty"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;"> Process</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">{{ $processCount }}</span></center>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="background-color: #8E44AD; color: #FFFFFF !important;"><i class="fa fa-sign-in"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Today's Login</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">@if(isset($firstCHECKTIME)) {{ date('H:i:s', strtotime($firstCHECKTIME->CHECKTIME)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon purple" style="background-color: #8E44AD; color: #FFFFFF !important;"><i class="fa fa-sign-out"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Today's Logout</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">@if(isset($lastCHECKTIME)) {{ date('H:i:s', strtotime($lastCHECKTIME->CHECKTIME)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon" style="background-color: #8E44AD; color: #FFFFFF !important;"><i class="fa fa-bell-o"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Attend This Month</span></center>
                                    <center><span class="info-box-number blink_me" style="font-size: 35px;">{{ $attenMonthCount }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <!-- <span class="info-box-icon "><i class="fa fa-arrow-right"></i></span> -->
                                <span class="info-box-icon ">IN</span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Today's Login</span></center>
                                    <center><span class="info-box-number blink_me" style="font-size: 35px;">@if(isset($firstCHECKTIME)) {{ date('H:i:s', strtotime($firstCHECKTIME->CHECKTIME)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <!-- <span class="info-box-icon "><i class="fa fa-pause"></i></span> -->
                                <span class="info-box-icon ">OUT</i></span>
                                <div class="info-box-content">

                                    <center><span class="info-box-text" style="font-size: 18px;">Today's Logout</span></center>

                                    <center><span class="info-box-number blink_me" style="font-size: 35px;">@if(isset($lastCHECKTIME)) {{ date('H:i:s', strtotime($lastCHECKTIME->CHECKTIME)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box bg-red">
                                <span class="info-box-icon "><i class="fa fa-share"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Late This Month(9:30)</span></center>
                                    <center><span class="info-box-number"><span style="font-size: 35px;">{{ $lateCount }}</span>{{ 'with Saturday' }}</span></center>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-tablet"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Yesterday's Login</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">@if(isset($firstYestrday)) {{ date('H:i:s', strtotime($firstYestrday->login)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-headphones"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Yesterday's Logout</span></center>
                                    <center><span class="info-box-number" style="font-size: 35px;">@if(isset($lastYestrday)) {{ date('H:i:s', strtotime($lastYestrday->logout)) }} @endif</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-paper-plane"></i></span>
                                <div class="info-box-content">
                                    <center><span class="info-box-text" style="font-size: 18px;">Absent This Month</span></center>
                                    <center><span class="info-box-number"><span style="font-size: 35px;">{{ date('d') - $attenMonthCount }}</span>{{ 'with Friday' }}</span> </center>
                                </div>
                            </div>
                        </div>
                    </div>
 

        </div>
    </div>

</section>
</div>
@endsection

@section('style')
    <style type="text/css">
        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

        /*marquee {
            width: 100%;
            padding: 10px 0;
            background-color: lightblue;
        }*/
    </style>
@endsection