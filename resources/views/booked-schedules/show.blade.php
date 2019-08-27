@extends('layouts.app')
@section('title')
BookedSchedule {{ $bookedschedule->id }}
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">BookedSchedule</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   BookedSchedule {{ $bookedschedule->id }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/booked-schedules') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <a href="{{ url('/booked-schedules/' . $bookedschedule->id . '/edit') }}" title="Edit BookedSchedule"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['bookedschedules', $bookedschedule->id],
                        'style' => 'display:inline'
                    ]) !!}
                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-sm',
                                'title' => 'Delete BookedSchedule',
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
                                    <td>{{ $bookedschedule->id }}</td>
                                </tr>
                                <tr>
                                    <th> Schedule </th>
                                    <td> {{ $bookedschedule->schedule_id }} </td>
                                </tr>
                                <tr>
                                    <th> Store </th>
                                    <td> {{ $bookedschedule->store_id }} </td>
                                </tr>
                                <tr>
                                    <th> Date </th>
                                    <td> {{ Carbon\Carbon::parse($bookedschedule->date)->format('d-m-Y') }} </td>
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
