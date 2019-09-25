@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/payment-method.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
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
    </div>
  </div>
</div>
@endsection
@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
	
</script>
@endsection