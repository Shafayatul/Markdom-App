@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/restaurant-details.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="restaurant-top-box">
      <span class="restaurant-name">Restaurant Name</span>
      <span class="store-rate-title">Store Rate</span>
      <span class="store-rating">
        @for ($i=0; $i < 3; $i++)
          <i class="fa fa-star"></i>
        @endfor
        <i class="fa fa-star text-success"></i>
        <i class="fa fa-star text-success"></i>
      </span>
    </div>
    <div class="restaurant-details-div">
      <h1 class="text-left">Restaurant Details</h1>
      <div class="restaurant-details-mother">
        <div class="restaurant-details-box">
          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
        </div>
        <div class="restaurant-details-box">
          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
        </div>
        <div class="restaurant-details-box">
          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
        </div>
      </div>
      <div class="store-location">
        <p class="text-left">Store location (select another location)</p>
        <p class="text-left">2.05 Km</p>
      </div>
      <div class="store-status text-left">
        <i class="fa fa-circle online"></i><span class="store-status-text">Store is Open (working time)</span>
      </div>
      <div class="order-button text-center">
        <a href="{{ route('order-details') }}"><button class="btn btn-success" type="button" name="button">Order Menu</button></a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection