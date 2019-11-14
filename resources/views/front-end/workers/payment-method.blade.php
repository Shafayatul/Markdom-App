@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/payment-method.css') }}">
<style type="text/css">
	.input-group{
		display: block !important;
	}
</style>
@endsection
@section('main-content')
<div class="address text-center model_section_container">
  <div class="container">
    <div class="wrapper">
    	<div class="grid">
	        <article class="cash-on-delivery">
	            <a class="total-a" id="cash-on-delivery-box" >
	              <div class="text">
	                <p class="cash_p">Cash On Delivery</p>
	              </div>
	            </a>
	        </article>
          <article class="bank-transfer">
              <a class="total-a" id="bank-transfer-box">
                  <div class="text">
                      <p class="color-black bank_p">Visa And Mastercard</p>
                  </div>
              </a>
          </article>
	        <article class="mada" id="mada">
	            <a href="#" class="total-a" id="mada-box">
	                <div class="text">
	                    <p class="color-black mada_p">Mada</p>
	                </div>
	            </a>
	        </article>
    	</div>

    @if (Session::has('order'))
      {{ Session::get('order') }}
    @endif
      <div class="row image-upload-bank-transfer-div">
          <div class="col-md-6 col-sm-12 offset-md-3">
            <h3 class="text-center">Upload Image Of Bank Transfer</h3>
            <form class="input-group bank-transfer-img-upload-form" enctype="multipart/form-data" id="bank-transfer-img-upload-form" action="{{ url('/worker-payment-bank-mada-transfer-submit') }}" method="post">
              @csrf
              <button type="button" class="close-image-box" id="close-image-box" name="close-image-box">Close</button>

              <div class='file-input'>
                <input type='file' size="60" name="image" id="image-file" required = 'required'>
                <span class='button'>Choose</span>
                <span class='label' data-js-label>No file selected</label>
              </div>
              <input type="hidden" name="payment_method" value="Bank Transfer">
              {{-- <button type="submit" name="button">@lang('payment.upload')</button> --}}
            </form>
          </div>
      </div>

    {{-- <input type="hidden" id="address_id" name="address_id" value="{{ $address_id }}"> --}}
	    @if ($result != null)
		    <div class="row mada-transfer-form-div">
		        <div class="col-md-6 offset-3">
		          <form class="input-group mada-transfer-form" id="mada-transfer-form" action="{{ url('/worker-payment-bank-mada-transfer-submit') }}" method="post">
		            @csrf
		            <input type="hidden" name="payment_method" value="Paytab">
		              <input type="hidden" name="paytab_transaction_id" value="{{ $result->transaction_id }}">
		          </form>
		        </div>
		    </div>
		@endif


	    <div class="payment-method-details-box text-center">
	      <div class="cash-on-delivery-details-box">
	        <div class="cash-on-delivery-img">
	          <img src="{{ asset('/front-end-assets/images/cash_on_delivery.png') }}" alt="">
	        </div>
	        <div class="cash-on-delivery-details">
	          {{-- <h3>@lang('payment.cash_on_delivery')</h3> --}}
	          <p>Avialable Service</p>
	        </div>
	      </div>

	      <div class="mada-details-box" style="display:none;">
	        <div class="cash-on-delivery-img">
	          <img src="{{ asset('/front-end-assets/images/mada.jpg') }}" alt="">
	        </div>
	        <div class="cash-on-delivery-details">
	          {{-- <h3 style="margin-top: 20px;">@lang('payment.mada')</h3> --}}
	        </div>
	      </div>


    </div>

    <div class="place-order-button">
        <div class="red_button shop_now_button place_order_button"><span>Complete</span></div>
    </div>

	    
    </div>
  </div>
  	
</div>
@endsection
{{-- @section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	
</script>
@endsection --}}
@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('front-end-assets/js/categories_custom.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function(){

    var place_order_button_id;

    if (localStorage.getItem('place_order_button_id') !=null) {
      $('.place_order_button').attr("id", localStorage.getItem('place_order_button_id'));
    }

    $('.image-upload-bank-transfer-div').hide();

    $('#cash-on-delivery-box').click(function() {

      $(".bank-transfer").css("background-color", "transparent");
      $(".bank_p").css("color", "#989898");

      $(".mada").css("background-color", "transparent");
      $(".mada_p").css("color", "#989898");

      $('.image-upload-bank-transfer-div').hide(500);

      $(".cash-on-delivery").css("background-color", "#1fc8db");
      $(".cash_p").css("color", "#fff");

      $(".cash-on-delivery-details-box").show();
      $(".mada-details-box").hide();
      $(".bank-transfer-details-box").hide();

      place_order_button_id = "cod-form-submit-ajax";
      $('.place_order_button').attr("id", place_order_button_id);

      if ($(window).width()<767) {
        var paymentMethosDetailsBoxPosition = $('.payment-method-details-box').position();
        $(window).scrollTop(paymentMethosDetailsBoxPosition.top+10);
      }

    });

    $('#bank-transfer-box').click(function() {
        $('.image-upload-bank-transfer-div').show(500);
        $(".bank-transfer").css("background-color", "#1fc8db");
        $(".bank_p").css("color", "#fff");

        $(".cash-on-delivery").css("background-color", "transparent");
        $(".cash_p").css("color", "#989898");

        $(".mada").css("background-color", "transparent");
        $(".mada_p").css("color", "#989898");

        $(".cash-on-delivery-details-box").hide();
        $(".mada-details-box").hide();
        $(".bank-transfer-details-box").show();

        place_order_button_id = "bank-transfer-form-submit";
        $('.place_order_button').attr("id", place_order_button_id);

        var bankTransferDivPosition = $(".image-upload-bank-transfer-div").position();

        $(window).scrollTop(bankTransferDivPosition.top+30);

        return false;
    });

    $('#mada-box').click(function() {
      $('.image-upload-bank-transfer-div').hide(500);

      $(".cash-on-delivery").css("background-color", "transparent");
      $(".cash_p").css("color", "#989898");

      $(".bank-transfer").css("background-color", "transparent");
      $(".bank_p").css("color", "#989898");

      $('.image-upload-bank-transfer-div').hide(500);

      $(".mada").css("background-color", "#1fc8db");
      $(".mada_p").css("color", "#fff");

      $(".cash-on-delivery-details-box").hide();
      $(".bank-transfer-details-box").hide();
      $(".mada-details-box").show();

      place_order_button_id = "mada-form-submit";
      $('.place_order_button').attr("id", place_order_button_id);

      localStorage.setItem('place_order_button_id','mada-form-submit');
      var main_url = '{{ env('MAIN_HOST_URL') }}';

      window.location.href = main_url+'worker-paytabs-payment';

      return false;
    });

    $('.close-image-box').click(function(){
      $('.image-upload-bank-transfer-div').hide(500);

      $(".bank-transfer").css("background-color", "transparent");
      $(".bank_p").css("color", "#989898");

      $(".mada").css("background-color", "transparent");
      $(".mada_p").css("color", "#989898");

      $(".cash-on-delivery").css("background-color", "#1fc8db");
      $(".cash_p").css("color", "#fff");

      $(".cash-on-delivery-details-box").show();
      $(".mada-details-box").hide();
      $(".bank-transfer-details-box").hide();

      place_order_button_id = "cod-form-submit-ajax";
      $('.place_order_button').attr("id", place_order_button_id);

      window.scrollTo(0, 0);

    });


    var address_id = localStorage.getItem('address_id');
    var promo_code = localStorage.getItem('promo_code');
    var schedule_timspan_id = localStorage.getItem('schedule_time_id');
    var service_type_id = localStorage.getItem('service_type_id');
    console.log(address_id);
    console.log(promo_code);
    console.log(schedule_timspan_id);
    console.log(service_type_id);

    $('#bank-transfer-img-upload-form').append('<input type="hidden" class="address_id" name="address_id" value='+address_id+'>');
    $('#bank-transfer-img-upload-form').append('<input type="hidden" class="promo_code" name="promo_code" value='+promo_code+'>');
    $('#bank-transfer-img-upload-form').append('<input type="hidden" class="schedule_timspan_id" name="schedule_timspan_id" value='+schedule_timspan_id+'>');
    $('#bank-transfer-img-upload-form').append('<input type="hidden" class="service_type_id" name="service_type_id" value='+service_type_id+'>');

    $(document).on('click', '#bank-transfer-form-submit', function(){
      var imgVal = $('#image-file').val();
      // alert(imgVal);
      if ($('#image-file').val() !='') {
        $("#bank-transfer-img-upload-form").submit();
      }else {
        alert('Please upload an image');
        return false;
      }
    });

    $('#mada-transfer-form').append('<input type="hidden" class="address_id" name="address_id" value='+address_id+'>');
    $('#mada-transfer-form').append('<input type="hidden" class="promo_code" name="promo_code" value='+promo_code+'>');
    $('#mada-transfer-form').append('<input type="hidden" class="schedule_timspan_id" name="schedule_timspan_id" value='+schedule_timspan_id+'>');
    $('#mada-transfer-form').append('<input type="hidden" class="service_type_id" name="service_type_id" value='+service_type_id+'>');


    $(document).on('click', '#mada-form-submit', function(){
      $("#mada-transfer-form").submit();
    });

    $(document).on('click', '#cod-form-submit-ajax', function(){
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type:"POST",
      url: "{{ route('worker-ajax-cod-submit') }}",
      data: {
        address_id : localStorage.getItem("address_id"),
        schedule_timspan_id : localStorage.getItem("schedule_time_id"),
        service_type_id : localStorage.getItem("service_type_id"),
        promo_code : localStorage.getItem("promo_code")
      },
      success:function(data) {
        console.log(data);
        if (data.msg="Success") {
          localStorage.removeItem("address_id");
          localStorage.removeItem("promo_code");
          var order_id = data.response.order.id;
          console.log(order_id);
          localStorage.setItem('order_id', order_id);
          window.location.href = "{{ url('/worker-notification') }}"+"/"+order_id;
        }
      }
    });
  });

  });

  // Also see: https://www.quirksmode.org/dom/inputfile.html

  var inputs = document.querySelectorAll('.file-input')

  for (var i = 0, len = inputs.length; i < len; i++) {
    customInput(inputs[i])
  }

  function customInput (el) {
    const fileInput = el.querySelector('[type="file"]')
    const label = el.querySelector('[data-js-label]')

    fileInput.onchange =
    fileInput.onmouseout = function () {
      if (!fileInput.value) return

      var value = fileInput.value.replace(/^.*[\\\/]/, '')
      el.className += ' -chosen'
      label.innerText = value
    }
  }


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
                  $(".discount").html("SR -"+data.order_summary.discount_amount);
                  $("#gnd_total").html("SR "+data.order_summary.grand_total);
              }
          }
      });
});


</script>
@endsection