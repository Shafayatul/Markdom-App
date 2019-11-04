@extends('layouts.app')
@section('title')
Driver Orders
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Driver Orders</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Driver Orders
                </div>
                <div class="panel-body">
                    @hasrole('driver')
                    <a href="{{ url('/orders/create') }}" class="btn btn-success btn-sm" title="Add New Order">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>

                    <br />
                    <br />
                    @endhasrole
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Details</th>
                                    <th>Price(SAR)</th>
                                    <th>Receipt</th>
                                    <th>Is Accept?</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($driverorders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->order_details }}</td>
                                    <td>{{ $item->offer_price }}</td>
                                    <td>
                                        @if(isset($item->receipt))
                                            <img src="{{ asset($item->receipt) }}" alt="" style="width: 80px; height: 80px;">
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->is_accepted == 1)
                                            <span style="color: green;">Accepted</span>
                                        @else
                                            <span style="color: red;">Not Accepted</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/driver-order/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        {{-- <a href="{{ url('/orders/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/driver-order-delete', $item->id],
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
                        <div class="pagination-wrapper"> {!! $driverorders->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
