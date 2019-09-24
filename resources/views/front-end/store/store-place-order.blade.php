@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-place-order.css') }}">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/product-summary.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
      <div class="product-details-div shadow">
        <?php
            $count = count($body);
            $cart_array = [];
            foreach ($body as $cart) {
              array_push($cart_array, $cart->cart_id);
            }
            $cart_string = implode(",",$cart_array);
          ?>
        @foreach($body as $cart)
        <div class="product-details-box shadow {{ 'rem'.$cart->cart_id }}">
          <button id="x" class="{{ 'close'.$cart->cart_id }} shadow remove_cart" cart_id="{{$cart->cart_id}}">
            X
          </button>
          <div class="product-image-box shadow">
            <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
          </div>
          <span class="service-name">{{ $cart->product_name }}</span><br>
          <span class="service-price">SR {{ $cart->price }}</span>
          <div class="product-amount shadow">
            <span class="plus" cart_id="{{$cart->cart_id}}"><i class="fa fa-plus-circle"></i></span>
            <span class="total-product value new_quantity">{{ $cart->quantity }}</span>
            <span class="minus" cart_id="{{$cart->cart_id}}"><i class="fa fa-minus-circle"></i></span>
          </div>
        </div>
        @endforeach
        <div class="product-details-box shadow">
          <div class="payment-summary-box">
            <div class="payment-summary-title">
              <h3>Product Summary</h3>
            </div>
            <hr>
            <?php
              $cnt = 0;
              foreach ($body as $cart) {
                $cnt = $cnt + $cart->total_price;
              }

              $shipping_charge = $single_address->city->delivery_fees;
              $grand_total = $cnt ;
            ?>
            <div class="payment-summary-content">
              <ul>
                <li>Sub Total <span>SR {{ $cnt }}</span></li>
                <li>Shipping <span>SR {{ $shipping_charge }}</span></li>
                {{-- <li id="discount_toggle"> @lang('product.discount') <span class="discount"></span></li> --}}
                <li>Grand Total <span id="gnd_total">SR {{ $grand_total }}</span></li>
              </ul>
            </div>
          </div>
        </div>


        {{-- <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
          </div>
          <span class="service-name">Service Name <br>{{ __('content.available_unit') }} 10 </span>
          <span class="total-amount">3</span>
          <span class="product-amount">30SR</span>
        </div> --}}

      </div>
      <div class="payment-details-div shadow">
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.payment_method') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">COD</p> </div>
        </div>
        <div class="payment-details-box">
          <div class="delivery-title"> <h1>{{ __('content.delivery_method') }}</h1> </div>
          <div class="delivery-description"> 
            <p class="font-p">Customer Location</p>
            {{-- @foreach ($address as $show_address)
            <a href="{{ url('/product-summary/'.$show_address->id) }}" style="text-decoration: none;">
              <div class="address-box effect">
                <p>{{ $show_address->flat_no }},{{ $show_address->location }}, {{ $show_address->state->name }}, {{ $show_address->city->name }}, {{ $show_address->country->name }},</p>
                <p>{{ $show_address->phone_no }},</p>
                <a class="delete-icon" href="{{ URL::to('/delete-address/'.$show_address->id) }}" ><i class="fa fa-trash"></i></a>
              </div>
            </a>
            @endforeach --}}
          </div>
          <div class="delivery-cost"> <p class="font-p">20SR</p></div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.date') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">
            {{ Carbon\Carbon::today()->format('d/m/Y') }}
          </p> </div>
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
  var cart_string = "{{ $cart_string }}";
  var cart_array = cart_string.split(",");


  if (cart_array != null) {
      $.each(cart_array, function(index, value) {
          $('.close' + value).on('click', function(c) {
              $('.rem' + value).fadeOut('slow', function(c) {
                  $('.rem' + value).remove();
              });
          });
      });
  }

  $(".remove_cart").click(function() {

      var cart_id = $(this).attr('cart_id');

      $.ajax({
          type: 'POST',
          url: "{{ url('/ajax-delete-cart') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
              'cart_id': cart_id
          },
          success: function(data) {
              console.log("Cart Item Deleted");
          }

      });
  });


  var new_quantity;

  $('.plus').on('click', function() {
      var divUpd = $(this).parent().find('.value'),

          newVal = parseInt(divUpd.text(), 10) + 1;
      divUpd.text(newVal);

      new_quantity = newVal;
      
      var cart_id = $(this).attr('cart_id');

      $.ajax({
          type: 'POST',
          url: "{{ url('/ajax-update-quantity-cart') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
              'cart_id': cart_id,
              'new_quantity': new_quantity
          },
          success: function(data) {
              console.log(data);
              // $('#cart-id-'+cart_id).html(data.new_quantity);

          }

      });
  });

  $('.minus').on('click', function() {
      var divUpd = $(this).parent().find('.value'),
          newVal = parseInt(divUpd.text(), 10) - 1;
      if (newVal >= 1) {
          divUpd.text(newVal);
          new_quantity = newVal;
      }

      var cart_id = $(this).attr('cart_id');
      if (new_quantity >= 1) {
          $.ajax({
              type: 'POST',
              url: "{{ url('/ajax-update-quantity-cart') }}",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                  'cart_id': cart_id,
                  'new_quantity': new_quantity
              },
              success: function(data) {
                  console.log(data);
                  $('#cart-id-'+cart_id).html(data.new_quantity);
              }

          });
      }

  });
</script>
@endsection
