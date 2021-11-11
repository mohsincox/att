<!-- <!DOCTYPE html>
<html>
    <head>
        <title>403</title>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title text-center">No Permission.</div>
                <div class="title text-center">Forbidden: 403 Error.</div>
            </div>
        </div>
    </body>
</html> -->

@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Accessibility</h3>
        </div>
        <div class="box-body">
            <div class="text-center" style="font-size: 72px; margin-bottom: 40px;">No Permission.</div>
            <div class="text-center" style="font-size: 72px; margin-bottom: 40px;">Access Forbidden: 403.</div>
        </div>
    </div>

</section>
</div>
@endsection