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
              $grand_total = $cnt + $shipping_charge;
            ?>
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
            {{-- <p class="font-p">Customer Location</p> --}}
            <a href="#" style="text-decoration: none;">
              <div class="address-box effect">
                @if(app()->getLocale() == 'en')
                <p>{{ $user->name }}</p>
                <p>{{ $single_address->flat_no }},{{ $single_address->location }}, {{ $single_address->state->name }}, {{ $single_address->city->name }}, {{ $single_address->country->name }},</p>
                <p>{{ $single_address->phone_no }},</p>
                @else
                  <p>{{ $user->name }}</p>
                  <p>{{ $single_address->flat_no }},{{ $single_address->location }}, {{ $single_address->state->name_arabic }}, {{ $single_address->city->name_arabic }}, {{ $single_address->country->name_arabic }},</p>
                  <p>{{ $single_address->phone_no }},</p>
                @endif
                {{-- <a class="delete-icon" href="{{ URL::to('/delete-address/'.$single_address->id) }}" ><i class="fa fa-trash"></i></a> --}}
              </div>
            </a>
          </div>
          <div class="delivery-cost"> <p class="font-p">SR {{ $shipping_charge }}</p></div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.date') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">
            <input type="date" name="delivery_date">
          </p> </div>
        </div>
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.time') }}</h1> </div>
          <div class="payment-description"> <input type="time" name="delivery_time"> </div>
        </div>

        <form>
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
        </form>
        

        <div class="place-order-button-div">
          @if ($count>0)
            <a href="{{ url('/store') }}"><button class="btn btn-success place-order-button" type="button" name="button">Continue Shopping</button></a>
            <a href="{{ url('/payment-method') }}"><button class="btn btn-success place-order-button" type="button" name="button">Continue To Payment</button></a>
          @endif
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
              location.reload(true);
          }

      });
  });


  var new_quantity;

  $('.plus').on('click', function() {
      var divUpd = $(this).parent().find('.value'),

      newVal = parseInt(divUpd.text(), 10) + 1;
      divUpd.text(newVal);

      new_quantity = newVal;
      location.reload(true);
      
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
              $('#cart-id-'+cart_id).html(data.new_quantity);
          }

      });
  });

  $('.minus').on('click', function() {
      var divUpd = $(this).parent().find('.value'),
          newVal = parseInt(divUpd.text(), 10) - 1;
      if (newVal >= 1) {
          divUpd.text(newVal);
          new_quantity = newVal;
          location.reload(true);
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

$("#discount_toggle").hide();
$("#promo_btn").click(function(e){
    e.preventDefault();
  var promo_code = $(".promo_code").val();
  var city_id = $(".city_id").val();

  window.localStorage.setItem('promo_code', promo_code);

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
