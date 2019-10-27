@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
    <div class="wrapper">
    	<div class="payment-details-div shadow">
	      	<div class="payment-details-box">
	      		<h4 class="text-center">Address Details</h4>
		       <hr>
		       <hr>
	          <div class="delivery-description"> 
	            {{-- <p class="font-p">Customer Location</p> --}}
	            @foreach ($address as $show_address)
	            <a href="{{ url('address-select/'.$show_address->id) }}" style="text-decoration: none;">
	              <div class="address-box effect">
	                <p>{{ $show_address->flat_no }},{{ $show_address->location }}, {{ $show_address->state->name }}, {{ $show_address->city->name }}, {{ $show_address->country->name }},</p>
	                <p>{{ $show_address->phone_no }},</p>
	                <a class="delete-icon" href="{{ URL::to('/delete-address/'.$show_address->id) }}" ><i class="fa fa-trash"></i></a>
	              </div>
	            </a>
	            
	            @endforeach
	          </div>
	          <a href="{{ url('/worker-add-address') }}" style="text-decoration: none;"><button class="btn btn-sm btn-success place-order-button" type="button" name="button">Add Delivery Address</button></a>
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