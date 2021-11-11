@extends('layouts.app')

@section('content')
<div class="container">
    <h1>
        Change Password
    </h1>
    <hr/>
<div class="col-sm-6">
    {!! Form::open(['url' => 'change-password-store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

    <!-- {!! Form::hidden('email', auth()->user()->email) !!} -->

    <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
        {!! Form::label('old_password', "Old Password", ['class' => 'required col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('old_password', ['class' => 'form-control']) !!}
        </div>
		<span class="help-block text-danger">
            {!! $errors->first('old_password') !!}
        </span>
    </div>

    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        {!! Form::label('password', "New Password", ['class' => 'required col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
		<span class="help-block text-danger">
            {!! $errors->first('password') !!}
        </span>
    </div>

    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'required col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>
		<span class="help-block text-danger">
            {!! $errors->first('password_confirmation') !!}
        </span>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Submit to Change Password', ['class' => 'fa fa-refresh btn btn-primary ', ]) !!}
            {{--{!! Form::button('<i class="fa fa-refresh"></i>'.Lang::get('password.reset_submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) !!}--}}
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>
@endsection