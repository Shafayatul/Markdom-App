@extends('layouts.app')
@section('title')
{{ $current_day->name }}:-> Schedule
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Schedule:-> {{ $stores[$store_id] }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">
                   {{ $current_day->name }}:-> Schedule
                </div>
                <div class="panel-body">
                    <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br/>
                    <br/>


                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Schedule Type</th>
                                    <th>Store</th>
                                    <th>Day</th>
                                    <th>Time Slot</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($schedule as $item)
                                <tr>
                                    <td> 
                                        @if(isset($scheduletypes[$item->schedule_type_id]))
                                            {{ $scheduletypes[$item->schedule_type_id] }}
                                        @endif
                                    </td>
                                    <td> 
                                        @if(isset($stores[$item->store_id]))
                                            {{ $stores[$item->store_id] }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($days[$item->day_id]))
                                            {{ $days[$item->day_id] }} 
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($item->timespan))
                                            {{ $item->timespan }} 
                                        @endif
                                    </td>
                                    <td>
                                        
                                        <a href="{{ url('/schedules/' . $item->id . '/edit') }}" title="Edit Schedule"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/schedules', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Schedule',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
