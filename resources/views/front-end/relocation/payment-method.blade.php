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
    <input type="hidden" id="address_id" name="address_id" value="{{ $address_id }}">
	    @if ($result != null)
		    <div class="row mada-transfer-form-div">
		        <div class="col-md-6 offset-3">
		          <form class="input-group mada-transfer-form" id="mada-transfer-form" action="{{ url('/relocation-payment-bank-mada-transfer-submit') }}" method="post">
		            @csrf
		            <input type="hidden" name="payment_method" value="Paytab">
		              <input type="text" name="paytab_transaction_id" value="{{ $result->transaction_id }}">
		          </form>
		        </div>
		    </div>
		@endif


	    <div class="payment-method-details-box text-center">

	      <div class="mada-details-box" style="display:none;">
	        <div class="cash-on-delivery-img">
	          <img src="{{ asset('/front-end-assets/images/mada.jpg') }}" alt="">
	        </div>
	        <div class="cash-on-delivery-details">
	          
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



    $('#mada-box').click(function() {
      $(".mada").css("background-color", "#1fc8db");
      $(".mada_p").css("color", "#fff");
      $(".mada-details-box").show();

      place_order_button_id = "mada-form-submit";
      $('.place_order_button').attr("id", place_order_button_id);

      localStorage.setItem('place_order_button_id','mada-form-submit');
      var main_url = '{{ env('MAIN_HOST_URL') }}';

      window.location.href = main_url+'relocation-paytabs-payment';

      return false;
    });


    var address_id = $("#address_id").val();


    $('#mada-transfer-form').append('<input type="hidden" class="address_id" name="address_id" value='+address_id+'>');


    $(document).on('click', '#mada-form-submit', function(){
      $("#mada-transfer-form").submit();
    });



  });


</script>
@endsection