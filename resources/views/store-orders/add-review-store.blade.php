@extends('layouts.app')
@section('title')
Create New Review
@endsection
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Review</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    @include('layouts.admin_partial.alert')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                   Create New Review
                </div>
                <div class="panel-body">
                    <a href="{{ url('/store-order') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => '/submit-reviews', 'files' => true]) !!}
                    <div class="form-group {{ $errors->has('star') ? 'has-error' : ''}}">
                        {!! Form::label('star', 'Star', ['class' => 'control-label']) !!}
                        {!! Form::select('star', (['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('star', '<p class="help-block">:message</p>') !!}
                    </div>
                    <input type="hidden" name="user_id" value="{{ $id }}">
                    <div class="form-group {{ $errors->has('review') ? 'has-error' : ''}}">
                        {!! Form::label('review', 'Review', ['class' => 'control-label']) !!}
                        {!! Form::textarea('review', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                        {!! $errors->first('review', '<p class="help-block">:message</p>') !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
