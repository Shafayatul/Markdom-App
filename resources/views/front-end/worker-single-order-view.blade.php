@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
      	<div class="table-responsive">
      		<h4 class="text-center">Worker</h4>
      		<hr>
      		<hr>
      		<table class="table table-bordered">
      			<tbody>
      				<tr>
                                    <th>Schedule</th>
                                    <td>
                                          @if(isset($response->schedule->timespan))
                                                {{ $response->schedule->timespan }}
                                          @endif
                                    </td>                   
                              </tr>
                              <tr>
                                    <th>Service Type</th>
                                    <td>
                                          @if(isset($response->service_type->title))
                                                {{ $response->service_type->title }}
                                          @endif
                                    </td>  
                              </tr>
                              <tr>
                                    <th>Product</th>
                                    <td>
                                          @if(isset($response->product->name))
                                                {{ $response->product->name }}
                                          @endif
                                    </td>
                              </tr>
                              <tr>
                                    <th>Final Price</th>
                                    <td>
                                          @if(isset($response->single_worker_order->final_price))
                                                {{ $response->single_worker_order->final_price }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Payment Method</th>
                                    <td>
                                          @if(isset($response->single_worker_order->payment_method))
                                                {{ $response->single_worker_order->payment_method }}
                                          @endif
                                    </td>
                              </tr>
                              @if(isset($response->single_worker_order->payment_method) == 'Paytab')
                              <tr>
                                    <th>Paytab transaction</th>
                                    <td>
                                          @if(isset($response->single_worker_order->paytab_transaction_id))
                                                {{ $response->single_worker_order->paytab_transaction_id }}
                                          @endif
                                    </td>
                              </tr>
                              @endif

                              <tr>
                                    <th>Promo Code</th>

                                    <td>
                                          @if(isset($response->single_worker_order->promo_code))
                                                {{ $response->single_worker_order->promo_code }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Discount Amount</th>

                                    <td>
                                          @if(isset($response->single_worker_order->discount_amount) == null || isset($response->single_worker_order->discount_amount) == ' ')
                                               {{ "0" }}
                                          @else
                                                {{ $response->single_worker_order->discount_amount }}
                                          @endif
                                    </td>
                              </tr>

                              <tr>
                                    <th>Discount Percent</th>

                                    <td>
                                          @if(isset($response->single_worker_order->discount_percent) == null || isset($response->single_worker_order->discount_percent) == ' ')
                                               {{ "0%" }}
                                          @else
                                                {{ $response->single_worker_order->discount_percent.'%' }}
                                          @endif
                                    </td>
                              </tr>
                              <tr>
                                    <th>Is Completed?</th>

                                    <td>
                                          @if(isset($response->single_worker_order->is_completed))
                                                @if($response->single_worker_order->is_completed == 1)
                                                      <span style="color: green;">Completed</span>
                                                @else
                                                      <span style="color: red;">Not Completed</span>
                                                @endif
                                          @endif
                                    </td>
                              </tr>
                              @if(isset($response->single_worker_order->payment_method) == 'Bank Transfer')
                              <tr>
                                    <th>Image</th>
                                    <td>
                                          @if(isset($response->single_worker_order->image))
                                                <img src="{{ asset($response->single_worker_order->image) }}" alt="" style="width: 200px; height: 200px;">
                                          @endif
                                    </td>
                              </tr>
                              @endif
      			</tbody>
      		</table>
      	</div>
  </div>
</div>
@endsection
@section('front-additional-js')

@endsection