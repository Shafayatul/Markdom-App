@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">RestuarentCustomerOrder {{ $restuarentcustomerorder->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/restuarent-customer-orders') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/restuarent-customer-orders/' . $restuarentcustomerorder->id . '/edit') }}" title="Edit RestuarentCustomerOrder"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('restuarentcustomerorders' . '/' . $restuarentcustomerorder->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete RestuarentCustomerOrder" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $restuarentcustomerorder->id }}</td>
                                    </tr>
                                    <tr><th> User Id </th><td> {{ $restuarentcustomerorder->user_id }} </td></tr><tr><th> Store Id </th><td> {{ $restuarentcustomerorder->store_id }} </td></tr><tr><th> Order Details </th><td> {{ $restuarentcustomerorder->order_details }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
