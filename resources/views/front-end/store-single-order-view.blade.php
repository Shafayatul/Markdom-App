@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
      	<div class="table-responsive">
      		<h4 class="text-center">Store</h4>
      		<hr>
      		<hr>
      		<table class="table table-bordered">
      			<tbody>
                              <tr>
                                    <th>Order Details</th>
                                    <td>{{ $response->single_store_order->order_details }}</td>
                              </tr>
                              <tr>
                                    <th>Payment Method</th>
                                    <td>{{ $response->single_store_order->payment_method }}</td>
                              </tr>
                               <tr>
                                    <th>Esimated Time</th>
                                    <td>{{ $response->single_store_order->estimated_time }}</td>
                              </tr>
                              <tr>
                                    <th>Paytab Transaction</th>
                                    <td>{{ $response->single_store_order->paytab_transation_id }}</td>
                              </tr>
                              <tr>
                                    <th>SMSA Awab Number</th>
                                    <td>{{ $response->single_store_order->smsa_awab_number }}</td>
                              </tr>
                              <tr>
                                    <th>Order Status</th>

                                    <td>
                                          @if(isset($response->order_status->order_status))
                                                {{ $response->order_status->order_status }}
                                          @endif
                                    </td>
                              </tr>
                              <tr>
                                    <th>Final Price</th>
                                    <td>
                                          @if(isset($response->single_store_order->final_price))
                                                {{ $response->single_store_order->final_price }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Promo Code</th>

                                    <td>
                                          @if(isset($response->single_store_order->promo_code))
                                                {{ $response->single_store_order->promo_code }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Discount Amount</th>

                                    <td>
                                          @if(isset($response->single_store_order->discount_amount) == null || isset($response->single_store_order->discount_amount) == ' ')
                                               {{ "0" }}
                                          @else
                                                {{ $response->single_store_order->discount_amount }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Discount Percent</th>

                                    <td>
                                          @if(isset($response->single_store_order->discount_percent) == null || isset($response->single_store_order->discount_percent) == ' ')
                                               {{ "0%" }}
                                          @else
                                                {{ $response->single_store_order->discount_percent.'%' }}
                                          @endif
                                    </td>
                              </tr>
      			</tbody>
      		</table>
      	</div>


            <div class="table-responsive">
                  <h4 class="text-center">Product</h4>
                  <hr>
                  <hr>
                  <table class="table table-bordered">
                        <thead>
                              <th>#</th>
                              <th>Product</th>
                              <th>Price</th>
                        </thead>
                        <tbody>
                              @foreach($response->products as $item)
                                    <tr>
                                          <td>{{ $loop->iteration }}</td>
                                          <td>{{ $item->name }}</td>
                                          <td>{{ $item->price }}</td>
                                    </tr>
                              @endforeach
                        </tbody>
                  </table>
            </div>


  </div>
</div>
@endsection
@section('front-additional-js')

@endsection