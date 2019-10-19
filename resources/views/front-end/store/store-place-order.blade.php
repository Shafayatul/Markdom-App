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
        <div class="product-details-box">
          <div class="payment-summary-box">
            <div class="payment-summary-title">
              <h3>Product Summary</h3>
            </div>
            <hr>


            <div class="delivery-option-box">
              <div class="delivery-option-title">
                <h3>Delivery Option</h3>
              </div>
              <hr>
              <div class="delivery-option-details">
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
            </div>

            <?php
              $cnt = 0;
              foreach ($body as $cart) {
                $cnt = $cnt + $cart->total_price;
              }

              $shipping_charge = $single_address->city->delivery_fees;
              $grand_total = $cnt + $shipping_charge;
            ?>


            <div class="shipment-box">
              <div class="shipment-title">
                <h3>Shipment</h3>
              </div>
              <hr>
              <div class="shipment-details">
                <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
                  <table class="table table-bordered">
                    @if(app()->getLocale() == 'en')
                      @foreach ($body as $show_cart)
                        <tr class="rem1">
                          {{-- <td class="invert-closeb">
                            <div class="rem">
                              <div class="close1" id="close"> </div>
                            </div>
                          </td> --}}

                          <td class="invert">{{ $show_cart->product_name }}</td>
                          <td class="invert">{{ $show_cart->total_price }}</td>
                        </tr>
                      @endforeach
                    @else
                      @foreach ($body as $show_cart)
                        <tr class="rem1">
                          {{-- <td class="invert-closeb">
                            <div class="rem">
                              <div class="close1" id="close"> </div>
                            </div>
                          </td> --}}

                          <td class="invert">{{ $show_cart->product_name_arabic }}</td>
                          <td class="invert">{{ $show_cart->total_price }}</td>
                        </tr>
                      @endforeach
                    @endif
                  </table>
                </div>
              </div>
            </div>
        </div>

            
    </div>
  </div>
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


  <div class="payment-details-div shadow">

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
        <a href="{{ url('/payment-method') }}"><button class="btn btn-success place-order-button" type="button" name="button">Continue To Payment</button></a>
      @endif
    </div>
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

var user_id = {{ $user->id }}
window.localStorage.setItem('user_id', user_id);


var address_id = {{ $single_address->id }}
window.localStorage.setItem('address_id', address_id);

</script>
@endsection
