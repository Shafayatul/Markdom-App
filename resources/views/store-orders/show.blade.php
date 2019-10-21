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
                                    <th>ID</th>
                                    <td>{{ $storeorder->id }}</td>
                                </tr>
                                <tr>
                                    <th> Total Price </th>
                                    <td> {{ $storeorder->grand_total_price }} </td>
                                </tr>
                                <tr>
                                    <th> Estimated Time </th>
                                    <td> {{ $storeorder->delivery_time }} </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td>
                                        @if(isset($order->image))
                                            <img src="{{ asset($storeorder->image) }}" alt="" style="width: 200px; height: 200px;">
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
