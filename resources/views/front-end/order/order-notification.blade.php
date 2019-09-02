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
      <form class="order-details-form" action="" method="post">
      <div class="review">
        <p>Give Your Review</p>
        <span class="store-rating">
          @for ($i=0; $i < 5; $i++)
            <i class="fa fa-star text-success"></i>
          @endfor
        </span>
      </div>
      <div class="review-input">
        <textarea class="text-left" name="message" placeholder="Add Your Review"></textarea>
      </div>

      <div class="order-button text-center">
        <button class="btn btn-success" type="button" name="button">Order Menu</button>
      </div>

        </form>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
