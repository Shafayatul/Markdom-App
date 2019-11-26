@extends('layouts.app')
@section('title')
Relocation Order {{ $relocation_order->id }}
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
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Relocation Order {{ $relocation_order->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/relocation-orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['relocation-order-delete', $relocation_order->id],
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
                                    <td>{{ $relocation_order->id }}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>
                                        @if(isset($users[$relocation_order->user_id]))
                                            {{ $users[$relocation_order->user_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Store</th>
                                    <td>
                                        @if(isset($stores[$relocation_order->store_id]))
                                            {{ $stores[$relocation_order->store_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Car Type</th>
                                    <td>
                                        @if(isset($car_types[$relocation_order->car_type_id]))
                                            {{ $car_types[$relocation_order->car_type_id] }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Latitude 1</th>
                                    <td>
                                        {{ $relocation_order->lat1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Longitude 1</th>
                                    <td>
                                        {{ $relocation_order->lng1 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Latitude 2</th>
                                    <td>
                                        {{ $relocation_order->lat2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Longitude 2</th>
                                    <td>
                                        {{ $relocation_order->lng2 }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price(SAR)</th>
                                    <td>
                                        {{ $relocation_order->price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($relocation_order->status == 0)
                                            <span class="text-danger">Pending</span>
                                        @else
                                            <span class="text-success">Confirmed</span>
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
