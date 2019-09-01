@if($formMode == 'create')
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
@endif

@if($formMode == 'edit')
    <input type="hidden" name="user_id" value="{{ $address->user_id }}">
@endif
<div class="form-group {{ $errors->has('flat_no') ? 'has-error' : ''}}">
    {!! Form::label('flat_no', 'Flat No', ['class' => 'control-label']) !!}
    {!! Form::text('flat_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('flat_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
    {!! Form::label('location', 'Location', ['class' => 'control-label']) !!}
    {!! Form::text('location', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('pin_code') ? 'has-error' : ''}}">
    {!! Form::label('pin_code', 'Pin Code', ['class' => 'control-label']) !!}
    {!! Form::text('pin_code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('pin_code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone_no') ? 'has-error' : ''}}">
    {!! Form::label('phone_no', 'Phone No', ['class' => 'control-label']) !!}
    {!! Form::text('phone_no', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone_no', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
    {!! Form::label('state_id', 'State', ['class' => 'control-label']) !!}
    {!! Form::select('state_id', $states, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', 'City', ['class' => 'control-label']) !!}
    {!! Form::select('city_id', $cities, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('country_id') ? 'has-error' : ''}}">
    {!! Form::label('country_id', 'Country', ['class' => 'control-label']) !!}
    {!! Form::select('country_id', $countries, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('country_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
