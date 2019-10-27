@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-notification.css') }}">
@endsection

@section('main-content')
<div class="order-notification text-center">
  <div class="container">
    <div class="order-notification-div">
      <div class="thank-you-msg">
        <h1>Thank You <br> For Your Order </h1>
        <p>Order Number : {{ $body->order->id }}</p>
      </div>
      <div class="image-div">
          <img src="{{ asset('front-end-assets/images/gift-box.png') }}" alt="">
      </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
