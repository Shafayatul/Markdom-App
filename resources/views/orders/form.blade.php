<div class="form-group {{ $errors->has('order_details') ? 'has-error' : ''}}">
    {!! Form::label('order_details', 'Order Details', ['class' => 'control-label']) !!}
    {!! Form::textarea('order_details', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'rows' => '3', 'cols' => '5'] : ['class' => 'form-control', 'rows' => '3', 'cols' => '5']) !!}
    {!! $errors->first('order_details', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('promo_code') ? 'has-error' : ''}}">
    {!! Form::label('promo_code', 'Promo Code', ['class' => 'control-label']) !!}
    {!! Form::text('promo_code', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('promo_code', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('delivery_time') ? 'has-error' : ''}}">
    {!! Form::label('delivery_time', 'Delivery Time', ['class' => 'control-label']) !!}
    {!! Form::time('delivery_time', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('delivery_time', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

@if($formMode == 'edit')
    <div class="form-group">
        <img src="{{ asset($order->image) }}" alt="" style="width: 100px; height: 100px;">
    </div>
@endif


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
