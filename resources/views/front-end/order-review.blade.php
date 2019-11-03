@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
    <div class="wrapper">
      	<form class="form-horizontal" action="{{ URL('/review-submit') }}" method="post">
	        @csrf
	       <h4 class="text-center">Review</h4>
	       <hr>
	       <hr>
			<div class="form-group {{ $errors->has('star') ? 'has-error' : ''}}">
			    {!! Form::label('star', 'Star', ['class' => 'control-label']) !!}
			    {!! Form::select('star', (['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			    {!! $errors->first('star', '<p class="help-block">:message</p>') !!}
			</div>
			<input type="hidden" name="type" value="{{ $type }}">
			<input type="hidden" name="order_id" value="{{ $id }}">
			<div class="form-group {{ $errors->has('review') ? 'has-error' : ''}}">
			    {!! Form::label('review', 'Review', ['class' => 'control-label']) !!}
			    {!! Form::textarea('review', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			    {!! $errors->first('review', '<p class="help-block">:message</p>') !!}
			</div>


			<div class="form-group">
			    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
			</div>
    	</form>
    </div>
  </div>
</div>
@endsection
@section('front-additional-js')

@endsection