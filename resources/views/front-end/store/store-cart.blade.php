@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-cart.css') }}">
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
          <span class="service-name">Service Name</span>
          <div class="product-amount shadow">
            <span class="plus"><i class="fa fa-plus-circle"></i></span>
            <span class="total-product">3</span>
            <span class="minus"><i class="fa fa-minus-circle"></i></span>
          </div>
        </div>
        <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
          </div>
          <span class="service-name">Service Name</span>
          <div class="product-amount shadow">
            <span class="plus"><i class="fa fa-plus-circle"></i></span>
            <span class="total-product">3</span>
            <span class="minus"><i class="fa fa-minus-circle"></i></span>
          </div>
        </div>

        <div class="place-order-button-div">
          <button class="btn btn-success place-order-button" type="button" name="button">{{ __('content.place_order') }}</button>
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
