@if(isset($option))
    {!! Form::model($option, ['url' => "option/$option->id", 'method' => 'put', 'class' => 'form-horizontal']) !!}
@else
    {!! Form::open(['url' => 'option', 'method' => 'post', 'class' => 'form-horizontal']) !!}
@endif

<div class="form-group {{ $errors->has('select_id') ? 'has-error' : '' }}">
    {!! Form::label('select_id', 'Select SELECT NAME', ['class' => 'required control-label col-sm-3 col-xs-3']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::select('select_id', $selectList, null, ['class' => 'form-control', 'placeholder' => 'Select SELECT NAME']) !!}
        <span class="text-danger">
            {{ $errors->first('select_id') }}
        </span>
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Option', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Option', 'autocomplete' => 'off']) !!}
        <span class="text-danger">
		    {{ $errors->first('name') }}
	    </span>
    </div>
</div>

@if(isset($option))
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'required col-3 col-sm-3 control-label']) !!}
    <div class="col-xs-9 col-sm-9">
        {!! Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], null, ['class' => 'form-control', 'placeholder' => 'Select Status']) !!}
        <span class="text-danger">
		    {{ $errors->first('status') }}
	    </span>
    </div>
</div>
@endif

<div class="box-footer">
	<!-- <button type="button" class="btn btn-default">Cancel</button> -->
	<a href="{{ url('/option') }}" class="btn btn-default">Cancel</a>
	@if(isset($option))
	    {!! Form::button('Submit', ['class' => 'btn btn-success pull-right', 'data-toggle' => 'modal', 'data-target' => '#option_update']) !!}
	@else
	    {!! Form::button('Submit', ['class' => 'btn btn-primary pull-right', 'data-toggle' => 'modal', 'data-target' => '#option_create']) !!}
	@endif
	
</div>

<div class="modal modal-info fade" id="option_create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmation Message</h4>
			</div>
			<div class="modal-body">
				<h3>Want to Create Option?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Create Option</button>
			</div>
		</div>
	</div>
</div>


<div class="modal modal-warning fade" id="option_update">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Confirmation Message</h4>
			</div>
			<div class="modal-body">
				<h3>Want to Update Option?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Update Option</button>
			</div>
		</div>
	</div>
</div>

{!! Form::close() !!}