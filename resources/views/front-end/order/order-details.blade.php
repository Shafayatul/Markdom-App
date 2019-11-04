@extends('layouts.front-end.master-layout')
@section('front-additional-css')
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-details.css') }}">

@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    {{-- <div class="order-details-div">
      <form class="order-details-form" action="{{ url('customer-order') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Order Details</p>
        <textarea class="text-left" name="order_details"></textarea>
        <br/>
        <br/>
        <input type="hidden" name="customer-latitude" id="latitude" readonly>
        <input type="hidden" name="customer-longitude" id="longitude" readonly>
        {{-- <div class="get-promo-code">
          <p>Get Promo Code</p>
          <span class="promo-code-input-span">
            <input type="text" name="" value="">
          </span>
          <span class="promo-code-button-span"> <button class="apply-button btn">Apply</button> </span>
        </div> --}}
        {{-- <input type="file" name="image" class="custom-file-input" style="display: inline-block !important;"> --}}
        {{-- <br/> --}}
        {{-- <p>Select Delivery Date: <br> <input type="text" class="delivery_time" id="datepicker"></p> --}}
        {{-- <div class="container"> --}}
          {{-- <div class="row">
              <div class='col-sm-6'>
                  <div class="form-group">
                      <div class='input-group date' id='datepicker'>
                          <input type='text' class="form-control" />
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  </div>
              </div>
          </div> --}}
        {{-- </div> --}}
        {{-- <input type="hidden" name="store_id" value="{{ $store_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <button class="btn btn-success btn-block" type="submit" name="button">
            <p>Next</p>
        </button>

      </form>
    </div>  --}}


    <div class="order-details-div">
      <form class="order-details-form" action="{{ url('customer-order') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Order Details</p>
        <textarea class="text-center" name="order_details"></textarea>
        <br/>
        <br/>
        <input type="file" name="image" class="custom-file-input">
        <input type="hidden" name="store_id" value="{{ $store_id }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <button class="btn btn-success btn-block" type="submit" name="button">
            <p>Next</p>
        </button>

      </form>
    </div>


    <!-- Button trigger modal -->
   {{--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
      Launch demo modal
    </button> --}}

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
            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ __('content.accept') }}</button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">{{ __('content.decline') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  $( function() {
     $('#datepicker').datetimepicker();
  });
  $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})

// function getLocation() {
//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(showPosition);
//   } else {
//     x.innerHTML = "Geolocation is not supported by this browser.";
//   }
// }

navigator.geolocation.getCurrentPosition(showPosition);

function showPosition(position) {
  $("#latitude").val(position.coords.latitude);
  $("#longitude").val(position.coords.longitude);
}
</script>
@endsection
