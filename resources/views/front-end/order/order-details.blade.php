@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-details.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="order-details-div">
      {{-- <form class="order-details-form" action="" method="post"> --}}
        <h1>
          @if(app()->getLocale() == 'en')
            {{ $product->name }}
          @else
            {{ $product->name_arabic }}
          @endif
        </h1>
        <p>Order Details</p>
        <p>
          @if(app()->getLocale() == 'en')
            {{ $product->description }}
          @else
            {{ $product->description_arabic }}
          @endif
        </p>
        {{-- <div class="get-promo-code">
          <p>Get Promo Code</p>
          <span class="promo-code-input-span">
            <input type="text" name="" value="">
          </span>
          <span class="promo-code-button-span"> <button class="apply-button btn">Apply</button> </span>
        </div> --}}
        <input type="file" class="custom-file-input">
        <p>Select Delivery Date: <br> <input type="text" id="datepicker"></p>
      {{-- </form> --}}
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="driver-img">
              <img src="{{ asset('front-end-assets/images/fa11.jpg') }}" alt="">
            </div>
            <div class="driver-box">
              <div class="driver-name">
                <p>Driver Name</p>
              </div>
              <div class="store-rating">
                @for ($i=0; $i < 3; $i++)
                  <i class="fa fa- "></i>
                  <i class="fa fa-star color-white"></i>
                @endfor
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <div class="driver-cost">
                <p>Driver Cost</p>
                <p>25 SR</p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">Accept</button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Decline</button>
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
  $( function() {
    $( "#datepicker" ).datepicker();
  });
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
@endsection
