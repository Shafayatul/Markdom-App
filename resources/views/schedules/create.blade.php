@extends('layouts.app')
@section('title')
Create New Schedule
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Schedule For Store:- {{ $store->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New Schedule
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/schedules', 'files' => true]) !!}

                    @include ('schedules.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer-script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#add-row').click(function(){
            var html_file = '<div class="row"><div class="col-md-6"><div class="form-group">{!! Form::label('from_time[]', 'From Time', ['class' => 'control-label']) !!}{!! Form::time('from_time[]', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}</div></div><div class="col-md-6"><div class="form-group">{!! Form::label('to_time[]', 'To Time', ['class' => 'control-label']) !!}{!! Form::time('to_time[]', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}</div></div></div>';
            $('.add-more-file-div').append(html_file);
        });
    });
</script>
@endsection