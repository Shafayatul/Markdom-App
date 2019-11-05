@extends('layouts.app')
@section('title')
Store Order {{ $storeorder->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Store Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Store Order {{ $storeorder->id }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Order Details</th>
                                    <td>{{ $storeorder->order_details }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ $storeorder->payment_method }}</td>
                                </tr>
                                <tr>
                                    <th>Esimated Time</th>
                                    <td>{{ $storeorder->estimated_time }}</td>
                                </tr>
                                <tr>
                                    <th>Paytab Transaction</th>
                                    <td>{{ $storeorder->paytab_transation_id }}</td>
                                </tr>
                                <tr>
                                    <th>SMSA Awab Number</th>
                                    <td>{{ $storeorder->smsa_awab_number }}</td>
                                </tr>
                                <tr>
                                    <th>Order Status</th>

                                    <td>
                                          @if(isset($orderstatus[$storeorder->order_status_id]))
                                                {{ $orderstatus[$storeorder->order_status_id] }}
                                          @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Final Price</th>
                                    <td>
                                          @if(isset($storeorder->final_price))
                                                {{ $storeorder->final_price }}
                                          @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Promo Code</th>

                                    <td>
                                          @if(isset($storeorder->promo_code))
                                                {{ $storeorder->promo_code }}
                                          @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Discount Amount</th>

                                    <td>
                                          @if(isset($storeorder->discount_amount) == null || isset($storeorder->discount_amount) == ' ')
                                               {{ "0" }}
                                          @else
                                                {{ $storeorder->discount_amount }}
                                          @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Discount Percent</th>

                                    <td>
                                          @if(isset($storeorder->discount_percent) == null || isset($storeorder->discount_percent) == ' ')
                                               {{ "0%" }}
                                          @else
                                                {{ $storeorder->discount_percent.'%' }}
                                          @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>
                                        {{ $address->flat_no.','.$address->location.','.$city->name.','.$state->name.','.$country->name }}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>


                    <div class="table-responsive">
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
                                    @foreach($products as $item)
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
            </div>
        </div>
    </div>
</div>
@endsection
