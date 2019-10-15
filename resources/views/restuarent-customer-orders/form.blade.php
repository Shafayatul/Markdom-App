<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'User Id' }}</label>
    <input class="form-control" name="user_id" type="text" id="user_id" value="{{ isset($restuarentcustomerorder->user_id) ? $restuarentcustomerorder->user_id : ''}}" >
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('store_id') ? 'has-error' : ''}}">
    <label for="store_id" class="control-label">{{ 'Store Id' }}</label>
    <input class="form-control" name="store_id" type="text" id="store_id" value="{{ isset($restuarentcustomerorder->store_id) ? $restuarentcustomerorder->store_id : ''}}" >
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order_details') ? 'has-error' : ''}}">
    <label for="order_details" class="control-label">{{ 'Order Details' }}</label>
    <textarea class="form-control" rows="5" name="order_details" type="textarea" id="order_details" >{{ isset($restuarentcustomerorder->order_details) ? $restuarentcustomerorder->order_details : ''}}</textarea>
    {!! $errors->first('order_details', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('driver_id') ? 'has-error' : ''}}">
    <label for="driver_id" class="control-label">{{ 'Driver Id' }}</label>
    <input class="form-control" name="driver_id" type="text" id="driver_id" value="{{ isset($restuarentcustomerorder->driver_id) ? $restuarentcustomerorder->driver_id : ''}}" >
    {!! $errors->first('driver_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('offer_price') ? 'has-error' : ''}}">
    <label for="offer_price" class="control-label">{{ 'Offer Price' }}</label>
    <input class="form-control" name="offer_price" type="text" id="offer_price" value="{{ isset($restuarentcustomerorder->offer_price) ? $restuarentcustomerorder->offer_price : ''}}" >
    {!! $errors->first('offer_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="text" id="image" value="{{ isset($restuarentcustomerorder->image) ? $restuarentcustomerorder->image : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('is_accepted') ? 'has-error' : ''}}">
    <label for="is_accepted" class="control-label">{{ 'Is Accepted' }}</label>
    <input class="form-control" name="is_accepted" type="text" id="is_accepted" value="{{ isset($restuarentcustomerorder->is_accepted) ? $restuarentcustomerorder->is_accepted : ''}}" >
    {!! $errors->first('is_accepted', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
