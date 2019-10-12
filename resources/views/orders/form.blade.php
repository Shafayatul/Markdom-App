<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Restuarants', ['class' => 'control-label']) !!}
    {!! Form::select('store_id', $stores, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Select a Store', 'id' => 'store_id'] : ['class' => 'form-control', 'placeholder'=>'Select a Store', 'id' => 'store_id']) !!}
    {!! $errors->first('store_id', '<p class"help-block">:message</p>') !!}
</div>
<div id="product-section1">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('product_id', 'Product', ['class' => 'control-label']) !!}
                <select id="product_1" name="product_id[]" class="form-control product" serial="1">
                    
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('price', 'Price', ['class' => 'control-label']) !!}
                <input type="text" name="price[]" class="form-control price" id="price_1" serial="1">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('qty', 'Qty', ['class' => 'control-label']) !!}
                <input type="number" name="qty[]" class="form-control qty" id="qty_1" serial="1">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button class="btn btn-sm btn-danger removeBtn" serial="1"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button class="btn btn-sm btn-success" onclick="addMores();"><i class="fa fa-plus"></i></button>
        </div>
    </div>
</div>

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
