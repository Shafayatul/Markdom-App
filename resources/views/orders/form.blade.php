<div class="form-group {{ $errors->has('unique_code') ? 'has-error' : ''}}">
    {!! Form::label('unique_code', 'Unique Code(Copied from chat box)', ['class' => 'control-label']) !!}
    {!! Form::text('unique_code', null, ('' == 'required') ? ['class' => 'form-control unique_code', 'required' => 'required', 'id' => 'unique_code'] : ['class' => 'form-control unique_code', 'id' => 'unique_code']) !!}
    {!! $errors->first('unique_code', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('food_cost') ? 'has-error' : ''}}">
    {!! Form::label('food_cost', 'Food Cost', ['class' => 'control-label']) !!}
    {!! Form::text('food_cost', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('food_cost', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('delivery_charge') ? 'has-error' : ''}}">
    {!! Form::label('delivery_charge', 'Delivery Charge', ['class' => 'control-label']) !!}
    {!! Form::text('delivery_charge', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('delivery_charge', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group {{ $errors->has('receipt') ? 'has-error' : ''}}">
    {!! Form::label('receipt', 'Receipt', ['class' => 'control-label']) !!}
    {!! Form::file('receipt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('receipt', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
</div>
