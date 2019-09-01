<div class="form-group {{ $errors->has('payment_type') ? 'has-error' : ''}}">
    {!! Form::label('payment_type', 'Payment Type', ['class' => 'control-label']) !!}
    {!! Form::text('payment_type', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('payment_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('payment_type_arabic') ? 'has-error' : ''}}">
    {!! Form::label('payment_type_arabic', 'Payment Type Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('payment_type_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('payment_type_arabic', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
