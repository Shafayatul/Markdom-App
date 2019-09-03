@extends('layouts.app')
@section('title')
OrderActivity {{ $orderactivity->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">OrderActivity</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   OrderActivity {{ $orderactivity->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/order-activities') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/order-activities/' . $orderactivity->id . '/edit') }}" title="Edit OrderActivity"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['order-activities', $orderactivity->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete OrderActivity',
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
                                    <td>{{ $orderactivity->id }}</td>
                                </tr>
                                <tr>
                                    <th> Order Id </th>
                                    <td> {{ $orderactivity->order_id }} </td>
                                </tr>
                                <tr>
                                    <th> Status </th>
                                    <td> {{ $orderactivity->status }} </td>
                                </tr>
                                <tr>
                                    <th> Status Arabic </th>
                                    <td> {{ $orderactivity->status_arabic }} </td>
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
