@extends('layouts.app')
@section('title')
Edit ScheduleType #{{ $scheduletype->name }}
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
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Edit ScheduleType #{{ $scheduletype->name }}
                </div>
                <div class="panel-body">
                    <a href="{{ url('/schedule-types') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($scheduletype, [
                        'method' => 'PATCH',
                        'url' => ['/schedule-types', $scheduletype->id],
                        'files' => true
                    ]) !!}

                    @include ('schedule-types.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
