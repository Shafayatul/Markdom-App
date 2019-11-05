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

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $driverorder->id }}</td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td>
                                        @if(isset($users[$driverorder->user_id])) 
                                            {{ $users[$driverorder->user_id] }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th> Order Details </th>
                                    <td> {{ $driverorder->order_details }} </td>
                                </tr>
                                <tr>
                                    <th> Offer Price(SAR) </th>
                                    <td> {{ $driverorder->offer_price }} </td>
                                </tr>
                                <tr>
                                    <th> Food Cost(SAR) </th>
                                    <td> {{ $driverorder->food_cost }} </td>
                                </tr>
                                <tr>
                                    <th> Delivery Charge(SAR) </th>
                                    <td> {{ $driverorder->delivery_charge }} </td>
                                </tr>
                                <tr>
                                    <th> Application Charge(SAR) </th>
                                    <td> {{ "5" }} </td>
                                </tr>
                                <tr>
                                    <th> Store </th>
                                    <td>
                                        @if(isset($stores[$driverorder->store_id])) 
                                            {{ $stores[$driverorder->store_id] }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th> Is Accepted? </th>
                                    <td>
                                        @if($driverorder->is_accepted == 1)
                                            <span style="color: green;">Accepted</span>
                                        @else
                                            <span style="color: red;">Not Accepted</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Is Completed? </th>
                                    <td>
                                        @if($driverorder->is_completed == 1)
                                            <span style="color: green;">Completed</span>
                                        @else
                                            <span style="color: red;">Not Completed</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Image </th>
                                    <td>
                                        @if(isset($driverorder->image))
                                            <img src="{{ asset($driverorder->image) }}" alt="" style="width: 200px; height: 200px;">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Receipt </th>
                                    <td>
                                        @if(isset($driverorder->receipt))
                                            <img src="{{ asset($driverorder->receipt) }}" alt="" style="width: 200px; height: 200px;">
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
