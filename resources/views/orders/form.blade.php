<div class="form-group {{ $errors->has('unique_code') ? 'has-error' : ''}}">
    {!! Form::label('unique_code', 'Unique Code(Copied from chat box)', ['class' => 'control-label']) !!}
    {!! Form::text('unique_code', null, ('' == 'required') ? ['class' => 'form-control unique_code', 'required' => 'required', 'id' => 'unique_code'] : ['class' => 'form-control unique_code', 'id' => 'unique_code']) !!}
    {!! $errors->first('unique_code', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('offer_price') ? 'has-error' : ''}}">
    {!! Form::label('offer_price', 'Price', ['class' => 'control-label']) !!}
    {!! Form::text('offer_price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('offer_price', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group {{ $errors->has('receipt') ? 'has-error' : ''}}">
    {!! Form::label('receipt', 'Receipt', ['class' => 'control-label']) !!}
    {!! Form::file('receipt', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('receipt', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
</div>
