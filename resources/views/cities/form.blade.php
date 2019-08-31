<div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
    {!! Form::label('state_id', 'State Id', ['class' => 'control-label']) !!}
    {!! Form::select('state_id', $states, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name_arabic') ? 'has-error' : ''}}">
    {!! Form::label('name_arabic', 'Name Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('name_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name_arabic', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('cod') ? 'has-error' : ''}}">
    {!! Form::label('cod', 'Cod', ['class' => 'control-label']) !!}
    {!! Form::text('cod', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cod', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('bank_transfers') ? 'has-error' : ''}}">
    {!! Form::label('bank_transfers', 'Bank Transfers', ['class' => 'control-label']) !!}
    {!! Form::text('bank_transfers', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('bank_transfers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('delivery_fees') ? 'has-error' : ''}}">
    {!! Form::label('delivery_fees', 'Delivery Fees', ['class' => 'control-label']) !!}
    {!! Form::text('delivery_fees', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('delivery_fees', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
