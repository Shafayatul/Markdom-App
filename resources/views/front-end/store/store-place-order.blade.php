@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-place-order.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
      <div class="product-details-div shadow">
        <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
          </div>
          <span class="service-name text-left">Service Name <br>{{ __('content.available_unit') }} 10 </span>
          <span class="total-amount">3</span>
          <span class="product-amount">30SR</span>
        </div>
        <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
          </div>
          <span class="service-name">Service Name <br>{{ __('content.available_unit') }} 10 </span>
          <span class="total-amount">3</span>
          <span class="product-amount">30SR</span>
        </div>
      </div>
      <div class="payment-details-div shadow">
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.payment_method') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">COD</p> </div>
        </div>
        <div class="payment-details-box">
          <div class="delivery-title"> <h1>{{ __('content.delivery_method') }}</h1> </div>
          <div class="delivery-description"> <p class="font-p">Customer Location</p></div>
          <div class="delivery-cost"> <p class="font-p">20SR</p></div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.date') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">20/10/2019</p> </div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.time') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">10am - 12pm</p> </div>
        </div>
        <div class="payment-details-box">
          <div class="promo-code"> <h1>{{ __('content.promo_code') }}</h1> </div>
          <div class="promo-input-div"> <input class="promo-input" type="text" name="" value=""> </div>
          <div class="promo-button"> <button class="btn btn-success" type="button" name="button">{{ __('content.apply') }}</button> </div>
        </div>
        <div class="place-order-button-div">
          <button class="btn btn-success place-order-button" type="button" name="button">{{ __('content.add_cart') }}</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

</script>
@endsection
