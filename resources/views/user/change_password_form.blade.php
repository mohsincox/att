@extends('layouts.app')

@section('content')
<div class="container">
<section class="content">
    <div class="row">
    	<div class="col-md-8 col-sm-offset-2">
        	<div class="box box-danger">
            	<div class="box-header with-border">
                	<h3 class="box-title">Change Password</h3> 
            	</div>
            	<div class="box-body">

            		<div class="col-sm-12">
						
						<div class="card">
							<div class="card-header">
								<h3 class="text-center"><i class="fa fa-lock"></i> Change <code><b>Password</b></code> </h3>
							</div>
							<div class="card-body">

                                {!! Form::open(['url' => 'change-password-store', 'method' => 'post', 'class' => 'form-horizontal']) !!}

                                <div class="form-group {{ $errors->has('old_password') ? 'has-error' : ''}}">
								    {!! Form::label('old_password', 'Old Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Enter Old Password', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('old_password') }}
									    </span>
								    </div>
								</div>

								<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
								    {!! Form::label('password', 'New Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter New Password', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('password') }}
									    </span>
								    </div>
								</div>

								<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
								    {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
								    <div class="col-xs-9 col-sm-9">
								        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'autocomplete' => 'off']) !!}
								        <span class="text-danger">
										    {{ $errors->first('password_confirmation') }}
									    </span>
								    </div>
								</div>

                                <div class="box-footer">
                                    
                                    <a href="{{ url('/') }}" class="btn btn-default">Cancel</a>
                                    
                                    {!! Form::button('Submit', ['class' => 'btn btn-danger pull-right', 'data-toggle' => 'modal', 'data-target' => '#change_pwd']) !!}
                          
                                </div>

                                <div class="modal modal-danger fade" id="change_pwd">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<h4 class="modal-title">Confirmation Message</h4>
											</div>
											<div class="modal-body">
												<h3>Want to Change Password?</h3>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-outline">Change Password</button>
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