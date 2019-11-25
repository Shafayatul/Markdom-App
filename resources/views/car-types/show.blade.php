@extends('layouts.app')
@section('title')
CarType {{ $cartype->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">CarType</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   CarType {{ $cartype->id }}
                </div>
                <div class="panel-body">

                    <a href="{{ url('/car-types') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/car-types/' . $cartype->id . '/edit') }}" title="Edit CarType"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['car-types', $cartype->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete CarType',
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
                                    <td>{{ $cartype->id }}</td>
                                </tr>
                                <tr>
                                    <th> Store </th>
                                    <td>
                                        @if(isset($relocstores[$cartype->store_id])) 
                                            {{ $relocstores[$cartype->store_id] }}
                                        @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $cartype->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $cartype->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Price </th>
                                    <td> {{ $cartype->per_mile_price }} </td>
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
