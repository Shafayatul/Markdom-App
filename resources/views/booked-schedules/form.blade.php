<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    {!! Form::label('date', 'Date', ['class' => 'control-label']) !!}
    {!! Form::date('date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Store', ['class' => 'control-label']) !!}
    {!! Form::select('store_id', $stores, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('schedule_id') ? 'has-error' : ''}}">
    {!! Form::label('schedule_id', 'Schedule', ['class' => 'control-label']) !!}
    {!! Form::select('schedule_id', $schedules, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('schedule_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
