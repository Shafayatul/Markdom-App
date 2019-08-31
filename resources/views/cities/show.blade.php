@extends('layouts.app')
@section('title')
City {{ $city->name }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">City</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   City {{ $city->name }}
                </div>
                <div class="panel-body">

                    <a href="{{ url('/cities') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/cities/' . $city->id . '/edit') }}" title="Edit City"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['cities', $city->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete City',
                                'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                    {!! Form::close() !!}
                    <br/>
                    <br/>

                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $city->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $city->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $city->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> State </th>
                                    <td> {{ $states[$city->state_id] }} </td>
                                </tr>
                                <tr>
                                    <th> Cod </th>
                                    <td> {{ $city->cod }} </td>
                                </tr>
                                <tr>
                                    <th> Bank Transfers </th>
                                    <td> {{ $city->bank_transfers }} </td>
                                </tr>
                                <tr>
                                    <th> Delivery Fees </th>
                                    <td> {{ $city->delivery_fees }} </td>
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
