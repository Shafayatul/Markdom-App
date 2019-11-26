@extends('layouts.app')
@section('title')
Relocation Orders
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Relocation Order</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Relocation Orders
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Store</th>
                                    <th>Car Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($relocation_orders as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if(isset($users[$item->user_id]))
                                            {{ $users[$item->user_id] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($stores[$item->store_id]))
                                            {{ $stores[$item->store_id] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($car_types[$item->car_type_id]))
                                            {{ $car_types[$item->car_type_id] }}
                                        @endif
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="text-danger">Pending</span>
                                        @else
                                            <span class="text-success">Confirmed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == 0)
                                            <a href="{{ url('/relocation-order-confirmed/'.$item->id) }}" title="Confirmed"><button class="btn btn-success btn-sm"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i></button></a>
                                        @else
                                            <a href="{{ url('/relocation-order-pending/'.$item->id) }}" title="Pending"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></button></a>
                                        @endif
                                        <a href="{{ url('relocation-order-view/'.$item->id) }}" title="View Order"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/relocation-order-delete', $item->id],
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
                        <div class="pagination-wrapper"> {!! $relocation_orders->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
