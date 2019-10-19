@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-place-order.css') }}">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-confirmation.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
        <div class="product-details-div shadow">
            <h3>Order Confirmation</h3>
            <hr/>
            <br/>
          <div class="product-details-box shadow">
            <div class="payment-summary-content">
              <div class="upper-content">
                <h3>Thank You</h3>
                <p class="bold-font">For Your Order</p>
                <p>Order Number : {{ $order->id }}</p>
              </div>

              <div class="transport-icon">
                <i class="fa fa-truck"></i>
              </div>

              <div class="lower-content">
                <p>Esimated Delivery</p>
                <p>Saturday Jul 13, 2020</p>
              </div>
            </div>

            <div class="place-order-button-div">
              @if ($order !=null)
                <a href="{{ url('/track-order/'.$order->id) }}">
                  <button class="btn btn-success place-order-button" type="button" name="button">Track Your Order Here</button>
                </a>
              @else
                <a href="{{ url('/track-order') }}">
                  <button class="btn btn-success place-order-button" type="button" name="button">Track Your Order Here</button>
                </a>
              @endif
                Or
                <a href="{{ url('/store') }}">
                  <button class="btn btn-success place-order-button" type="button" name="button">Continue To Shopping</button>
                </a>
            </div>
          </div>
        </div>
       </div>
    </div>
</div>
@endsection

@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    if (localStorage.getItem("address_id") !=null) {
      localStorage.removeItem("address_id");
      localStorage.removeItem("promo_code");
    }

    if (localStorage.getItem('place_order_button_id') !=null) {
      localStorage.removeItem("place_order_button_id");
    }

    // var order_id = localStorage.getItem("order_id");
    // alert(order_id);
  });
</script>
@endsection
