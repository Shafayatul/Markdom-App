@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
      	<div class="table-responsive">
      		<h4 class="text-center">Restaurent</h4>
      		<hr>
      		<hr>
      		<table class="table table-bordered">
      			<tbody>
      				<tr>
      					<th>Store</th>
      					<td>
      						@if(isset($response->store->name))
      							{{ $response->store->name }}
      						@endif
      					</td>
      				</tr>
      				<tr>
      					<th>Order Details</th>
      					<td>{{ $response->single_restaurent_order->order_details }}</td>
      				</tr>
      				<tr>
      					<th>Driver</th>
      					<td>
      						@if(isset($response->driver->name))
      							{{ $response->driver->name }}
      						@endif
      					</td>
      				</tr>
      				<tr>
      					<th>Offer Price</th>
      					<td>
      						@if(isset($response->single_restaurent_order->offer_price))
      							{{ $response->single_restaurent_order->offer_price }}
      						@endif
      					</td>
      				</tr>
      				<tr>
      					<th>Is Accepted?</th>
      					<td>
      						@if(isset($response->single_restaurent_order->is_accepted))
      							@if($response->single_restaurent_order->is_accepted == 1)
      								<span style="color: green;">Accepted</span>
      							@else
      								<span style="color: red;">Not Accepted</span>
      							@endif
      						@endif
      					</td>
      				</tr>

                              <tr>
                                    <th>Is Completed?</th>

                                    <td>
                                          @if(isset($response->single_restaurent_order->is_completed))
                                                @if($response->single_restaurent_order->is_completed == 1)
                                                      <span style="color: green;">Completed</span>
                                                @else
                                                      <span style="color: red;">Not Completed</span>
                                                @endif
                                          @endif
                                    </td>
                              </tr>
      				<tr>
      					<th>Image</th>
      					<td>
      						@if(isset($response->single_restaurent_order->image))
      							<img src="{{ asset($response->single_restaurent_order->image) }}" alt="" style="width: 200px; height: 200px;">
      						@endif
      					</td>
      				</tr>


      			</tbody>
      		</table>
      	</div>
  </div>
</div>
@endsection
@section('front-additional-js')

@endsection