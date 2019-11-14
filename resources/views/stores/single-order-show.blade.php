@extends('layouts.app')
@section('title')
Order {{ $single_worker_order->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Order {{ $single_worker_order->id }}
                </div>
                <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Schedule</th>
                                        <td>
                                            @if(isset($schedule->timespan))
                                                {{ $schedule->timespan }}
                                            @endif
                                        </td>                   
                                    </tr>
                                    <tr>
                                        <th>Service Type</th>
                                        <td>
                                              @if(isset($service_type->title))
                                                    {{ $schedule->title }}
                                              @endif
                                        </td>  
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>
                                              @if(isset($product->name))
                                                    {{ $product->name }}
                                              @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Final Price</th>
                                        <td>
                                              @if(isset($single_worker_order->final_price))
                                                    {{ $single_worker_order->final_price }}
                                              @endif
                                        </td>
                                    </tr>

                                    <tr>
                                      <th>Payment Method</th>
                                      <td>
                                            @if(isset($single_worker_order->payment_method))
                                                  {{ $single_worker_order->payment_method }}
                                            @endif
                                      </td>
                                    </tr>

                                    @if($single_worker_order->payment_method == 'Paytab')
                                      <tr>
                                        <th>Paytab transaction</th>
                                        <td>
                                              @if(isset($single_worker_order->paytab_transaction_id))
                                                    {{ $single_worker_order->paytab_transaction_id }}
                                              @endif
                                        </td>
                                      </tr>
                                    @endif

                                    <tr>
                                        <th>Promo Code</th>

                                        <td>
                                              @if(isset($single_worker_order->promo_code))
                                                    {{ $single_worker_order->promo_code }}
                                              @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Discount Amount</th>

                                        <td>
                                              @if(isset($single_worker_order->discount_amount) == null || isset($single_worker_order->discount_amount) == ' ')
                                                   {{ "0" }}
                                              @else
                                                    {{ $single_worker_order->discount_amount }}
                                              @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Discount Percent</th>

                                        <td>
                                              @if(isset($single_worker_order->discount_percent) == null || isset($single_worker_order->discount_percent) == ' ')
                                                   {{ "0%" }}
                                              @else
                                                    {{ $single_worker_order->discount_percent.'%' }}
                                              @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Is Completed?</th>

                                        <td>
                                              @if(isset($single_worker_order->is_completed))
                                                    @if($single_worker_order->is_completed == 1)
                                                          <span style="color: green;">Completed</span>
                                                    @else
                                                          <span style="color: red;">Not Completed</span>
                                                    @endif
                                              @endif
                                        </td>
                                    </tr>

                                    @if($single_worker_order->payment_method == 'Bank Transfer')
                                      <tr>
                                        <th>Image</th>
                                        <td>
                                              @if(isset($single_worker_order->image))
                                                  <a href="{{ url($single_worker_order->image) }}" download>
                                                    <img src="{{ asset($single_worker_order->image) }}" alt="" style="width: 200px; height: 200px;">
                                                  </a>
                                              @endif
                                        </td>
                                      </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
