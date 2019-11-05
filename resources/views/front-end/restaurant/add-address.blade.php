@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
    <div class="wrapper">
      	<form class="form-horizontal" action="{{ URL('/restaurant-address-submit') }}" method="post">
	        @csrf
	       <h4 class="text-center">Address Details</h4>
	       <hr>
	       <hr>
	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">Flat No</label>
	        	<div class="col-md-9">
	        		<input class="form-control" type="text" name="flat_no" placeholder="flat no...">
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">Location</label>
	        	<div class="col-md-9">
	        		<input class="form-control" type="text" name="location" placeholder="Location...">
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">Country</label>
	        	<div class="col-md-9">
	        		<select id="country_id" class="country_id form-control" name="country_id">
		                <option disable>--Select Country--</option>
		                @if(app()->getLocale() == 'en')
		                  @foreach ($country as $show_country)
		                    <option value="{{ $show_country->id }}" >{{ $show_country->name }}</option>
		                  @endforeach
		                @else
		                  @foreach ($country as $show_country)
		                    <option value="{{ $show_country->id }}">{{ $show_country->name_arabic }}</option>
		                  @endforeach
		                @endif
		            </select>
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">State</label>
	        	<div class="col-md-9">
	        		<select id="state_id" class="state_id form-control" name="state_id">
		                
		            </select>
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">City</label>
	        	<div class="col-md-9">
	        		<select id="city_id" class="city_id form-control" name="city_id">
		                
		            </select>
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">Pin Code</label>
	        	<div class="col-md-9">
	        		<input class="form-control" type="text" name="pin_code" placeholder="Pin Code...">
	        	</div>
	        </div>

	        <div class="form-group">
	        	<label for="flat_no" class="control-label col-md-3">Phone No</label>
	        	<div class="col-md-9">
	        		<input class="form-control" type="text" name="phone_no" placeholder="Phone No...">
	        	</div>
	        </div>

	        <div class="form-group">
	        	<div class="col-md-9 col-md-offset-3">
	        		<button class="btn btn-sm btn-success" type="submit">
		                Add Details
		            </button>
	        	</div>
	        </div>
    	</form>
    </div>
  </div>
</div>
@endsection
@section('front-additional-js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  	
$('.country_id').on('change',function() {
  var state_html = '<option disable>SELECT STATE</option>';

  var country_id = $('.country_id').val();
  alert(country_id);
  $.ajax({
    type: 'POST',
    url: "{{ url('/ajax-state-list') }}",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      'country_id': country_id
    },
    success: function(data) {
      state = data.states;
      console.log(state);
      $.each(state, function(index, value ){
        state_html = state_html + '<option value="'+value.id+'">'+value.name+'</option>'
      });
      $('.state_id').html(state_html);
    }

  });
});



$('.state_id').on('change',function() {

  var city_html = '<option disable>SELECT CITY</option>';

  var state_id = $('.state_id').val();

  $.ajax({
    type: 'POST',
    url: "{{ url('/ajax-city-list') }}",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      'state_id': state_id
    },
    success: function(data) {
      cities = data.cities;
      $.each(cities, function(index, value ){
        city_html = city_html + '<option value="'+value.id+'">'+value.name+'</option>'
      });
      $('.city_id').html(city_html);
    }

  });
});


</script>
@endsection