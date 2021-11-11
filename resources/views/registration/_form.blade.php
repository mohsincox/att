
{!! Form::open(['url' => 'user-registration', 'method' => 'post', 'class' => 'form-horizontal']) !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('name') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('email') }}
	    </span>
    </div>
</div>


<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Enter Password', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('password') }}
	    </span>
    </div>
</div>

<div class="form-group {{ $errors->has('designation_id') ? 'has-error' : ''}}">
                                    {!! Form::label('designation_id', 'Designation', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                       {!! Form::select('designation_id', $desigList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Designation']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('designation_id') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="form-group {{ $errors->has('department_id') ? 'has-error' : ''}}">
                                    {!! Form::label('department_id', 'Department', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('department_id', $deptList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Department']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('department_id') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('process_id') ? 'has-error' : ''}}">
                                    {!! Form::label('process_id', 'Process', ['class' => 'required col-3 col-sm-3 control-label']) !!}
                                    <div class="col-xs-9 col-sm-9">
                                        {!! Form::select('process_id', $processList, null, ['class' => 'select2 form-control', 'placeholder' => 'Select Process']) !!}
                                        <span class="text-danger">
                                            {{ $errors->first('process_id') }}
                                        </span>
                                    </div>
                                </div>


<div class="box-footer">
	<a href="{{ url('/user-registration') }}" class="btn btn-default">Cancel</a>
	{!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#user_create']) !!}
</div>

<div class="modal modal-info fade" id="user_create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmation Message</h4>
			</div>
			<div class="modal-body">
				<h3>Want to Create User?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Create User</button>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}