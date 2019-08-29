@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-details.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="order-details-div">
      <form class="order-details-form" action="" method="post">
        <p>Order Details</p>
        <textarea class="text-left" name="message"></textarea>
        <div class="get-promo-code">
          <p>Get Promo Code</p>
          <span class="promo-code-input-span">
            <input type="text" name="" value="">
          </span>
          <span class="promo-code-button-span"> <button class="apply-button btn">Apply</button> </span>
        </div>
        <input type="file" class="custom-file-input">
        <p>Select Delivery Date: <br> <input type="text" id="datepicker"></p>
      </form>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $( function() {
    $( "#datepicker" ).datepicker();
  });
</script>
@endsection
