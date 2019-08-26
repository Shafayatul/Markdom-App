@extends('layouts.app')
@section('title')
Order {{ $order->id }}
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
                   Order {{ $order->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/orders/' . $order->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['orders', $order->id],
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
                                    <td>{{ $order->id }}</td>
                                </tr>
                                <tr>
                                    <th> Order Details </th>
                                    <td> {{ $order->order_details }} </td>
                                </tr>
                                <tr>
                                    <th> Promo Code </th>
                                    <td> {{ $order->promo_code }} </td>
                                </tr>
                                <tr>
                                    <th> Delivery Time </th>
                                    <td> {{ $order->delivery_time }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td>
                                        @if(isset($order->image))
                                            <img src="{{ asset($order->image) }}" alt="" style="width: 200px; height: 200px;">
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
