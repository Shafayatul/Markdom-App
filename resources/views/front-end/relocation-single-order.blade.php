@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
	<div class="table-responsive">
		<h4 class="text-center">Relocation</h4>
		<hr>
		<hr>
		<table class="table table-bordered">
			<tbody>
                        <tr>
                              <th>Store</th>
                              <td>
                                    @if(isset($stores[$response->relocation_order->store_id]))
                                          {{ $stores[$response->relocation_order->store_id] }}
                                    @endif
                              </td>
                        </tr>
                        <tr>
                              <th>Car Type</th>
                              <td>
                                    @if(isset($cartypes[$response->relocation_order->car_type_id]))
                                          {{ $cartypes[$response->relocation_order->car_type_id] }}
                                    @endif
                              </td>
                        </tr>
                         <tr>
                              <th>Latitude 1</th>
                              <td>{{ $response->relocation_order->lat1 }}</td>
                        </tr>
                        <tr>
                              <th>Longitude 1</th>
                              <td>{{ $response->relocation_order->lng1 }}</td>
                        </tr>
                         <tr>
                              <th>Latitude 2</th>
                              <td>{{ $response->relocation_order->lat2 }}</td>
                        </tr>
                        <tr>
                              <th>Longitude 2</th>
                              <td>{{ $response->relocation_order->lng2 }}</td>
                        </tr>
                        <tr>
                              <th>Payment method</th>
                              <td>{{ $response->relocation_order->payment_method }}</td>
                        </tr>
                        <tr>
                              <th>Paytab Trabsaction Id</th>
                              <td>{{ $response->relocation_order->paytab_transaction_id }}</td>
                        </tr>
                        <tr>
                              <th>Status</th>
                              <td>
                                    @if($response->relocation_order->status == 1)
                                          <span class="text-success">Confirmed</span>
                                    @else
                                          <span class="text-danger">Pending</span>
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