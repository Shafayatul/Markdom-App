@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-notification.css') }}">
@endsection

@section('main-content')
<div class="order-notification text-center">
  <div class="container">
    <div class="order-notification-div">
      <div class="thank-you-msg">
        <h1>Thank You <br> For Your Order </h1>
      </div>
      <div class="image-div">
        <div class="image-box"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
