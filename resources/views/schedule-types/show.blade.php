@extends('layouts.app')
@section('title')
ScheduleType {{ $scheduletype->name }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">ScheduleType</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   ScheduleType {{ $scheduletype->name }}
                </div>
                <div class="panel-body">

                    <a href="{{ url('/schedule-types') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/schedule-types/' . $scheduletype->id . '/edit') }}" title="Edit ScheduleType"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['schedule-types', $scheduletype->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete ScheduleType',
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
                                    <td>{{ $scheduletype->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name </th>
                                    <td> {{ $scheduletype->name }} </td>
                                </tr>
                                <tr>
                                    <th> Name Arabic </th>
                                    <td> {{ $scheduletype->name_arabic }} </td>
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
