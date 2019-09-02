<div class="form-group {{ $errors->has('order_status') ? 'has-error' : ''}}">
    {!! Form::label('order_status', 'Order Status', ['class' => 'control-label']) !!}
    {!! Form::text('order_status', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('order_status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order_status_arabic') ? 'has-error' : ''}}">
    {!! Form::label('order_status_arabic', 'Order Status Arabic', ['class' => 'control-label']) !!}
    {!! Form::text('order_status_arabic', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('order_status_arabic', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
