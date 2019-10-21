@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-place-order.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="wrapper">
      <div class="product-details-div shadow">
        
        @foreach($body as $cart)
        <div class="product-details-box shadow">
          <div class="product-image-box shadow">
            <img src="{{ asset(env('MAIN_HOST_URL').$cart->preview_image) }}" alt="">
          </div>
          <span class="service-name">{{ $cart->product_name }}</span>
          <div class="product-amount shadow">
            {{-- <span class="plus"><i class="fa fa-plus-circle"></i></span> --}}
            <span class="total-product">{{ $cart->quantity }}</span>
            {{-- <span class="minus"><i class="fa fa-minus-circle"></i></span> --}}
          </div>
        </div>
        @endforeach
        <input type="hidden" name="time_slot" value="{{ $schedule_timspan_id }}">
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
        <div class="payment-details-box">
          <div class="payment-title"> <h1>{{ __('content.date') }}</h1> </div>
          <div class="payment-description"> <p class="font-p">20/10/2019</p> </div>
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
          <a href="{{ route('worker-notification') }}"><button class="btn btn-success place-order-button" type="button" name="button">{{ __('content.place_order') }}</button></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

</script>
@endsection
