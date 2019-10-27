@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/waiting.css') }}">
@endsection
@section('main-content')
<div class="order-section text-centar">
  	<div class="conainer">
	   	<div class="order-heading row">
	   		<h2>My orders</h2>
	   	</div>
		<table cellspacing="10">
			<th class="Active">
				<h2>Active Orders</h2>
			</th>
			<tbody id="active-offers">
				{{-- <tr class="table_row">			
					<td width="10%" class="img">
						<a href="#"> 
							<img src="{{ asset('front-end-assets/images/avater.png') }}" alt=""> karamcafe 
						</a>	
			        </td>
			        <td width="20%">
			        	<a class="offer-code" href="">#57091019</a>
			        </td>         		 
				</tr> --}}
			</tbody>
		</table>
		<div class="waiting">				
			<div class="fandition" >	
				<p>waiting to offer</p>
				<p>
					<div class="item-1"></div>
				  	<div class="item-2"></div>
				  	<div class="item-3"></div>
				</p>	
			</div>	
		</div>
		<div class="container text-centar">
			<div class="row-fluid row">
				<div class="span12">
					<ul class="unstyled">
					  	<li>
					  		<i class="fa fa-cart-plus"></i><br>
					  		<a href='#'>Order</a>
					  	</li>
					  	<li>
					  		<i class="fa fa-car" aria-hidden="true"></i><br> 
					  		<a href='#'>My Offer</a>
					  	</li>
					  	<li>
					  		<i class="fa fa-paper-plane" aria-hidden="true"></i><br>
					  		<a href='#'>Delivery</a>
					  	</li>
					   	<li>
					   		<i class="fa fa-user" aria-hidden="true"></i><br>
					   		<a href=''>My profile</a>
					   	</li>
					</ul>

				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="hidden-restaurant-offer-customer" name="hidden-restaurant-offer-customer" value="{{ $restuarent_customer_order_id}}">
{{-- <input type="hidden" id="hidden-is-accepted" name="hidden-is-accepted" value="{{ $restuarent_customer_order->is_accepted }}">
<input type="hidden" id="hidden-lat" name="hidden-lat" value="{{ $store->lat }}">
<input type="hidden" id="hidden-lon" name="hidden-lon" value="{{ $store->lan }}"> --}}
<input type="hidden" id="hidden-waiting-page"  value="yes">

@endsection

