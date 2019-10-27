@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-cart.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">

      <div class="product-details-div shadow">
        <div class="row">
              <div class="col text-center">
                  <div class="section_title new_arrivals_title">
                      <h2>Cart</h2>
                  </div>
              </div>
          </div>
          <br/>
          <br/>
        {{-- @foreach($body as $cart)
        <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
          </div>
          <span class="service-name">{{ $cart->product_name }}</span>
          <div class="product-amount shadow">
            <span class="total-product">{{ $cart->quantity }}</span>
          </div>
        </div>
        @endforeach --}}

        <?php
          $count = count($body);
          $cart_array = [];
          foreach ($body as $cart) {
            array_push($cart_array, $cart->cart_id);
          }
          $cart_string = implode(",",$cart_array);
        ?>

        <div class="table-responsive">
          <table class="table table-bordered table-primary">
            <thead class="bg-primary">
              <th class="white">Remove</th>
              <th class="white">Product</th>
              <th class="white">Product Name</th>
              <th class="white">Quantity</th>
              <th class="white">Price(SAR)</th>
            </thead>
            <tbody>
              @foreach($body as $cart)
              <tr>
                <td>
                  <div class="rem">
                      <div class="{{ "close".$cart->cart_id  }} remove_cart" id="close" cart_id="{{$cart->cart_id}}"> </div>
                  </div>
                </td>
                <td>
                  <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="" class="cart-img">
                </td>
                <td>
                    <div class="product_name">
                      {{ $cart->product_name }}
                    </div>
                </td>
                <td>
                  <div class="quantity">
                      <div class="quantity-select">
                          <div class="entry minus" cart_id="{{$cart->cart_id}}"></div>
                          <div class="entry value"><span class="new_quantity">{{ $cart->quantity }}</span></div>
                          <div class="entry plus" cart_id="{{$cart->cart_id}}"></div>
                      </div>
                  </div>
                </td>
                <td>
                  <div class="product_price">
                    {{ $cart->price }}
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
          </div>
          <span class="service-name">Service Name</span>
          <div class="product-amount shadow">
            <span class="plus"><i class="fa fa-plus-circle"></i></span>
            <span class="total-product">3</span>
            <span class="minus"><i class="fa fa-minus-circle"></i></span>
          </div>
        </div> --}}

        <div class="place-order-button-div">
          @if ($count>0)
            <a href="{{ url('/store') }}"><button class="btn btn-success place-order-button" type="button" name="button">Continue Shopping</button></a>
            <a href="{{ url('/address') }}"><button class="btn btn-success place-order-button" type="button" name="button">ADD DELIVERY DETAILS</button></a>
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
</script>
@endsection
