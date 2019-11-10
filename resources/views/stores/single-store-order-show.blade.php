@extends('layouts.app')
@section('title')
Order {{ $single_store_order->id }}
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
                   Order {{ $single_store_order->id }}
                </div>
                <div class="panel-body">
                    
                    <a href="{{ url('/stores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $single_store_order->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $user->name }} </td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td> {{ $address->flat_no.','.$address->location.','.$city->name.','.$state->name.','.$country->name }} </td>
                                </tr>
                                <tr>
                                    <th> Final Price </th>
                                    <td> {{ $single_store_order->final_price }} </td>
                                </tr>
                                <tr>
                                    <th> Order Status </th>
                                    <td> {{ $order_status->order_status }} </td>
                                </tr>
                                <tr>
                                    <th> Payment method </th>
                                    <td> {{ $single_store_order->payment_method }} </td>
                                </tr>
                                <tr>
                                    <th> Delivery Time </th>
                                    <td> {{ $single_store_order->estimated_time }} </td>
                                </tr>
                                <tr>
                                    <th> Paytab Transation </th>
                                    <td> {{ $single_store_order->paytab_transation_id }} </td>
                                </tr>
                                <tr>
                                    <th> SMSA Awab Number </th>
                                    <td> {{ $single_store_order->smsa_awab_number }} </td>
                                </tr>
                                <tr>
                                    <th> Promo Code </th>
                                    <td> {{ $single_store_order->promo_code }} </td>
                                </tr>
                                <tr>
                                    <th> Discount Amount </th>
                                    <td> {{ $single_store_order->discount_amount }} </td>
                                </tr>
                                <tr>
                                    <th> Discount Percent </th>
                                    <td> {{ $single_store_order->discount_percent }} </td>
                                </tr>
                                @if(isset($single_store_order->image) != null)
                                    <tr>
                                        <th>Image</th>
                                        <td>
                                            <img src="{{ asset($single_store_order->image) }}">
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


    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Product list
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <th>#</th>
                                <th>Store</th>
                                <th>Product</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if(isset($stores[$product->store_id]))
                                                {{ $stores[$product->store_id] }}
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
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
@endsection
