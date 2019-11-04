@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/order-review.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
    <div class="wrapper">
      	<form class="form-horizontal" action="{{ URL('/review-submit') }}" method="post">
	        @csrf
	       <h4 class="text-center">Review </h4>
	       <hr>
	       <hr>
			{{-- <div class="form-group {{ $errors->has('star') ? 'has-error' : ''}}">
			    {!! Form::label('star', 'Star', ['class' => 'control-label']) !!}
			    {!! Form::select('star', (['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5']), null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			    {!! $errors->first('star', '<p class="help-block">:message</p>') !!}
			</div> --}}
			 <!-- Rating Stars Box -->
			<section class='rating-widget'>
  
				  <!-- Rating Stars Box -->
				  <div class='rating-stars text-center'>
				    <ul id='stars'>
				      <li class='star' title='Poor' data-value='1'>
				        <i class='fa fa-star fa-fw'></i>
				      </li>
				      <li class='star' title='Fair' data-value='2'>
				        <i class='fa fa-star fa-fw'></i>
				      </li>
				      <li class='star' title='Good' data-value='3'>
				        <i class='fa fa-star fa-fw'></i>
				      </li>
				      <li class='star' title='Excellent' data-value='4'>
				        <i class='fa fa-star fa-fw'></i>
				      </li>
				      <li class='star' title='WOW!!!' data-value='5'>
				        <i class='fa fa-star fa-fw'></i>
				      </li>
				    </ul>
				  </div>
				  
				  <div class='success-box'>
				    <div class='clearfix'></div>
				    {{-- <img alt='tick image' width='32' src='data:'/> --}}
				    <div class='text-message'></div>
				    <input type="hidden" id="star" name="star">
				    <div class='clearfix'></div>
				  </div>			  
  
			</section>

			<input type="hidden" name="type" value="{{ $type }}">
			<input type="hidden" name="order_id" value="{{ $id }}">
			<div class="form-group {{ $errors->has('review') ? 'has-error' : ''}}">
			    {!! Form::label('review', 'Review', ['class' => 'control-label']) !!}
			    {!! Form::textarea('review', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
			    {!! $errors->first('review', '<p class="help-block">:message</p>') !!}
			</div>


			<div class="form-group">
			    {!! Form::submit('Create', ['class' => 'btn btn-success btn-block']) !!}
			</div>
    	</form>
    </div>
  </div>
</div>
@endsection
@section('front-additional-js')
<script type="text/javascript">
	$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    $("#star").val(ratingValue);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
    }
    responseMessage(msg);
    
  });
  
  
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box div.text-message').html("<span>" + msg + "</span>");
}
</script>
@endsection