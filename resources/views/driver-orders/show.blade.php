@extends('layouts.app')
@section('title')
Driver Order {{ $driverorder->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Driver Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Driver Order {{ $driverorder->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/driver-orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    {{-- <a href="{{ url('/orders/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['driver-order-delete', $driverorder->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete Order',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $driverorder->id }}</td>
                                </tr>
                                <tr>
                                    <th> Order Details </th>
                                    <td> {{ $driverorder->order_details }} </td>
                                </tr>
                                <tr>
                                    <th> Total Price </th>
                                    <td> {{ $driverorder->grand_total_price }} </td>
                                </tr>
                                <tr>
                                    <th> Estimated Time </th>
                                    <td> {{ $driverorder->delivery_time }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td>
                                        @if(isset($order->image))
                                            <img src="{{ asset($driverorder->image) }}" alt="" style="width: 200px; height: 200px;">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                   Driver Order Data
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($driverorderdatas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(isset($products[$item->product_id]))
                                            {{ $products[$item->product_id] }}
                                        @endif
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->total_price }}</td>
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
