<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Code', ['class' => 'control-label']) !!}
    {!! Form::text('code', $code, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly'] : ['class' => 'form-control', 'readonly' => 'readonly']) !!}
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'control-label']) !!}
    {!! Form::select('type',(['Percent'=>'Percentage','Amount'=>'Amount']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'promo_code_select'] : ['class' => 'form-control','id'=>'promo_code_select']) !!}
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('percent') ? 'has-error' : ''}}" id="percentage">
    {!! Form::label('percent', 'Percent', ['class' => 'control-label']) !!}
    {!! Form::text('percent', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('percent', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}" id="amount">
    {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
    {!! Form::text('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
