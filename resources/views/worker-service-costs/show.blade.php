@extends('layouts.app')
@section('title')
WorkerServiceCost {{ $workerservicecost->name }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">WorkerServiceCost</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   WorkerServiceCost {{ $workerservicecost->name }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/worker-service-costs') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/worker-service-costs/' . $workerservicecost->id . '/edit') }}" title="Edit WorkerServiceCost"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['worker-service-costs', $workerservicecost->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete WorkerServiceCost',
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
                                    <td>{{ $workerservicecost->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $workerservicecost->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $workerservicecost->name_arabic }} </td>
                                </tr>
                                <tr>
                                    <th> Price </th>
                                    <td> {{ $workerservicecost->price }} </td>
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
