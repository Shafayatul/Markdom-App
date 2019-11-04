@extends('layouts.app')
@section('title')
Orders
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders</h1>
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
                    <a href="{{ url('/stores') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>

                    <br />
                    <br />
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Store</th>
                                    <th>Total Price</th>
                                    <th>Delivery Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($driverorders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(isset($stores[$item->store_id]))
                                            {{ $stores[$item->store_id] }}
                                        @endif
                                    </td>
                                    <td>{{ $item->final_price }}</td>
                                    <td>{{ $item->estimated_time }}</td>
                                    <td>
                                        <a href="{{ url('/order/' . $item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        {{-- <a href="{{ url('/orders/' . $item->id . '/edit') }}" title="Edit Order"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a> --}}
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/order-delete', $item->id],
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
