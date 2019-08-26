@extends('layouts.app')
@section('title')
Orders
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
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Orders
                </div>
                <div class="panel-body">
                    <a href="{{ url('/orders/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Details</th>
                                    <th>Promo Code</th>
                                    <th>Image</th>
                                    <th>Delivery Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->order_details }}</td>
                                    <td>{{ $item->promo_code }}</td>
                                    <td>
                                        @if(isset($item->image))
                                            <img src="{{ asset($item->image) }}" alt="" style="width: 80px; height: 80px;">
                                        @endif
                                    </td>
                                    <td>{{ $item->delivery_time }}</td>
                                    <td>
                                        <a href="{{ url('/orders/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/orders/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/orders', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Order',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $orders->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
