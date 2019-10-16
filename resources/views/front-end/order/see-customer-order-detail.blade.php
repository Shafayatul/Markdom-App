@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-details.css') }}">
<style type="text/css">
  input[type=text] {
    border-radius: 0px !important;
  }
</style>
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="order-details-div">
      
        
        @if(isset($restuarant_customer_order->image) != null)
          <img src="{{ asset($restuarant_customer_order->image) }}" alt="" style="width: 300px; height: 300px;">
          <input type="hidden" name="image" value="{{ $restuarant_customer_order->image }}">
        @endif

        <input type="hidden" id="restuarent_customer_order_id" name="restuarent_customer_order_id" value="{{ $id }}">
        <input type="hidden" id="driver_id" name="driver_id" value="{{ $driver->id }}">
        <input type="hidden" id="driver_name" name="driver_name" value="{{ $driver->name }}">
        <input type="hidden" id="customer_id" name="customer_id" value="{{ $customer->id }}">
        <input type="hidden" id="customer_name" name="customer_name" value="{{ $customer->name }}">

        <div class="col-md-12">
          <p class="text-center">Customer Order Details</p>
        </div>
        <div class="col-md-12">
          <p>
          {{ $restuarant_customer_order->order_details }}
          </p>
        </div>
        <div class="col-md-12">
          <p>Store Name: {{ $store->name }}</p>
          <p>Location: {{ $store->location }}</p>
          <div class="review">
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="pwd">Price:</label>
            <input type="text" id="offer_price_by_driver" class="form-control" id="pwd">
          </div>
        </div>
        <button class="btn btn-success btn-block" id="send-offer-by-driver" type="submit" name="button">
            <p>Sent Offer</p>
        </button>
    </div>
  </div>
</div>
@endsection