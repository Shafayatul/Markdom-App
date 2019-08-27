<div class="row">
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
		    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
		    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group {{ $errors->has('name_arabic') ? 'has-error' : ''}}">
		    {!! Form::label('name_arabic', 'Name Arabic', ['class' => 'control-label']) !!}
		    {!! Form::text('name_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
		    {!! $errors->first('name_arabic', '<p class="help-block">:message</p>') !!}
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="form-group">
		    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
</div>


