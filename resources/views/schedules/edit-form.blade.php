<div class="form-group {{ $errors->has('day_id') ? 'has-error' : ''}}">
    {!! Form::label('day_id', 'Day', ['class' => 'control-label']) !!}
    {!! Form::select('day_id', $days, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Pick a Day...'] : ['class' => 'form-control', 'placeholder' => 'Pick a Day...']) !!}
    {!! $errors->first('day_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Store', ['class' => 'control-label']) !!}
    {!! Form::select('store_id', $stores, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Pick a Store...'] : ['class' => 'form-control', 'placeholder' => 'Pick a Store...']) !!}
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('schedule_type_id') ? 'has-error' : ''}}">
    {!! Form::label('schedule_type_id', 'Schedule Type', ['class' => 'control-label']) !!}
    {!! Form::select('schedule_type_id', $scheduletypes, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Pick a Schedule Type...'] : ['class' => 'form-control', 'placeholder' => 'Pick a Schedule Type...']) !!}
    {!! $errors->first('schedule_type_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="row">
    
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('from_time') ? 'has-error' : ''}}">
            {!! Form::label('from_time', 'From Time', ['class' => 'control-label']) !!}
            {!! Form::time('from_time', $timespans[0], ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('from_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('to_time') ? 'has-error' : ''}}">
            {!! Form::label('to_time', 'To Time', ['class' => 'control-label']) !!}
            {!! Form::time('to_time', $timespans[1], ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
            {!! $errors->first('to_time', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
