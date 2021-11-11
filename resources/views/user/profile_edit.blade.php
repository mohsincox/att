@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-success">
            	<div class="box-header with-border">
                	<h3 class="box-title">Profile</h3> 
                	<div class="box-tools pull-right">
                		<a href="{{ url('profile') }}" class="btn btn-primary btn-flat"> <i class="fa fa-eye"></i> View Profile</a>
                	</div>
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-edit"></i> Update <code><b>Profile</b></code> </h3>
							</div>
							<div class="card-body">

                                {!! Form::open(['url' => 'profile-update', 'method' => 'post', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

                                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
								    {!! Form::label('name', 'Name', ['class' => 'required col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('name') }}
									    </span>
								    </div>
								</div>

								<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
								    {!! Form::label('email', 'Email', ['class' => 'required col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('email') }}
									    </span>
								    </div>
								</div>

								<p class="text-center">Please use real email address (if you forget password you will reset it by email)</p>

								<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
								    {!! Form::label('phone_number', 'Phone Number', ['class' => 'col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::text('phone_number', Auth::user()->phone_number, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('phone_number') }}
									    </span>
								    </div>
								</div>

								<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
								    {!! Form::label('address', 'Address', ['class' => 'col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::text('address', Auth::user()->address, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('address') }}
									    </span>
								    </div>
								</div>

								<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
								    {!! Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) !!}
								    <div class="col-sm-9">
								        {!! Form::file('image', ['class' => 'form-control',  'onchange' => 'readURL(this)', 'placeholder' => 'Enter video', 'autocomplete' => 'off']) !!}
								        <span class="help-block text-danger">
								            {{ $errors->first('image') }}
								        </span>
								        <div>
								            @if(isset(Auth::user()->image))
								                {{ Html::image('public/uploads/'.Auth::user()->image, 'image', ['id' => 'preview', 'width' => 100, 'height' => 100]) }}
								            @else
								                {{ Html::image('#', 'image', ['id' => 'preview']) }}
								            @endif
								        </div>
								    </div>
								</div>

                                <div class="box-footer">
                                    
                                    <a href="{{ url('/profile') }}" class="btn btn-default">Cancel</a>
                                    
                                    {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#profile_update']) !!}
                          
                                </div>

                                <div class="modal modal-success fade" id="profile_update">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title">Confirmation Message</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Want to Update Profile?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline">Update Profile</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {!! Form::close() !!}
							</div>
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
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('assets/js/select2.full.min.js') }}"></script>

     <script type="text/javascript">
        $(function () {
            $('.select2').select2()
        })

        function readURL(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            reader.onload = function (e) {
	                $('#preview')
	                        .attr('src', e.target.result)
	                        .width(100)
	                        .height(100);
	            };
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
    </script>
@endsection