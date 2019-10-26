@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-place-order.css') }}">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/product-summary.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
      <form action="{{ route('worker-order-submit') }}" method="POST">
        @csrf
      <div class="product-details-div shadow">
          <div class="shipment">
            <h3>Shipment</h3>
          </div> 
        @foreach($body as $cart)
        {{-- <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
          </div>
          <span class="service-name">{{ $cart->product_name }}</span>
          <span class="product-amount">30SR</span>
          <div class="product-amount shadow">
            <span class="total-product">{{ $cart->quantity }}</span>
          </div>
        </div> --}}
        {{-- <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
          </div>
          <span class="service-name">{{ $cart->product_name }} </span>
          <span class="total-amount">{{ $cart->quantity }}</span>
          <span class="product-amount">{{ $cart->price }}SR</span>
        </div> --}}

        <div id="product-details">
                  
          <div class="product-details-box shadow">
           
            <div class="product-image-box shadow">
              <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
            </div>
            <span class="service-name">{{ $cart->product_name }}
            <br> 
               <span class="product-amount">{{ $cart->price }}SR</span>

            </span>
            

            <span class="total-amount">{{ $cart->quantity }}</span>
           
          </div>
        </div>
        @endforeach
        <input type="hidden" name="schedule_time_id" value="{{ $schedule_timspan_id }}">
        <input type="hidden" name="service_type_id" value="{{ $service_type_id }}">
          <input type="hidden" name="address_id" value="{{ $single_address->id }}" />
      </div>


            <?php
              $cnt = 0;
              foreach ($body as $cart) {
                $cnt = $cnt + $cart->total_price;
              }

              $shipping_charge = $single_address->city->delivery_fees;
              $grand_total = $cnt + $shipping_charge;
            ?>
      <div class="product-details-div shadow">
        <div class="product-details-box shadow">
          <h3>Product Summary</h3>
          <div class="payment-summary-content">
            <ul>
              <li>Sub Total <span>SR {{ $cnt }}</span></li>
              <li>Shipping <span>SR {{ $shipping_charge }}</span></li>
              <li id="discount_toggle"> Discount <span class="discount"></span></li>
              <li>Grand Total <span id="gnd_total">SR {{ $grand_total }}</span></li>
            </ul>
          </div>
        </div>
      </div>


      <div class="payment-details-div shadow">
        <div class="payment-details-box">
          <div class="payment-title">  </div>
          <div class="payment-description"> 
            <a href="{{ url('/worker-address') }}">
              <button class="btn btn-success btn-sm">Add Delivery Address</button>
            </a> 
          </div>
        </div>
        <div class="payment-details-box">
          <div class="delivery-title"> <h1>Address</h1> </div>
          <div class="delivery-description">
                @if(app()->getLocale() == 'en')
                  <p>{{ $user->name }}</p>
                  <p>{{ $single_address->flat_no }}, {{ $single_address->location }}, {{ $single_address->state->name }}, {{ $single_address->city->name }}</p>
                  <p>Phone No : {{ $single_address->phone_no }}</p>
                @else
                  <p>{{ $user->name }}</p>
                  <p>{{ $single_address->flat_no }}, {{ $single_address->location_arabic }}, {{ $single_address->state->name_arabic }}, {{ $single_address->city->name_arabic }}</p>
                  <p>Phone No : {{ $single_address->phone_no }}</p>
                @endif
          </div>
          <div class="delivery-cost"> <p class="font-p"></p></div>
        </div>
{{--         <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.date') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">20/10/2019</p> </div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.time') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">10am - 12pm</p> </div>
        </div> --}}


        <div class="payment-details-box">
          <div class="promo-code"> <h1>{{ __('content.promo_code') }}</h1> </div>
          <div class="promo-input-div"> 
            <input class="promo-input promo_code" id="promo_code" type="text" name="promo_code"> 
          </div>
              <input type="hidden" class="city_id" value="{{ $single_address->city->id }}" />
           
          <div class="promo-button"> 
            <button class="btn btn-success" type="button" name="button" id="promo_btn">{{ __('content.apply') }}</button> 
          </div>
        </div>


        <div class="place-order-button-div">
          <button class="btn btn-success place-order-button" type="submit" name="button">{{ __('content.place_order') }}</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$("#discount_toggle").hide();
$("#promo_btn").click(function(e){
    e.preventDefault();
  var promo_code = $(".promo_code").val();
  var city_id = $(".city_id").val();

    $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:"POST",
          url: "{{ route('check-promo-code') }}",
          data: {
            promo_code : promo_code,
            city_id : city_id
          },
          success:function(data) {
            console.log(data.order_summary);
              if(data.msg != 'Success'){
                  alert('Not Valid Promo Code.Please Insert Valid Promo Code.');
                  window.location.href = "{{url()->current()}}";
                  $("#discount_toggle").hide();
              }else{
                  $("#discount_toggle").show();
                  $(".discount").html("SR "+data.order_summary.discount_amount);
                  $("#gnd_total").html("SR "+data.order_summary.grand_total);
              }
          }
      });
});
</script>
@endsection
