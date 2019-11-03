@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/add-address.css') }}">
@endsection
@section('main-content')
<div class="address text-center">
  <div class="container">
  		@if(Session::has('success'))
  			@if(app()->getLocale() == 'en')
  				<div class="alert alert-success alert-dismissable">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <a href="#" class="alert-link">Success</a> {{ Session::get('success') }}
			    </div>
  			@else
  				<div class="alert alert-success alert-dismissable">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <a href="#" class="alert-link">Success</a> {{ Session::get('success') }}
			    </div>
  			@endif
		    
		@endif

		@if(Session::has('review-msg'))
  				<div class="alert alert-success alert-dismissable">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <a href="#" class="alert-link"></a> @lang('content.reviewed_msg')
			    </div>
		@endif
      	<div class="table-responsive">
      		@if($response->type == 'Restaurant')
      		<h4 class="text-center">{{ $response->type }}</h4>
      		<hr>
      		<hr>
      		<table class="table table-bordered">
      			<thead>
      				<th>#</th>
      				<th>Order Details</th>
      				<th>Offer Price(SAR)</th>
      				<th>Is Accepted?</th>
      				<th>Is Completed?</th>
      				<th>Actions</th>
      			</thead>
      			<tbody>
      				@foreach($response->customer_orders as $item)
	      				<tr>
	      					<td>{{ $loop->iteration }}</td>
	      					<td>{{ $item->order_details }}</td>
	      					<td>{{ $item->offer_price }}</td>
	      					<td>
	      						@if($item->is_accepted == 1)
	      							<span style="color: green;">Accepted</span>
	      						@else
	      							<span style="color: red;">Not Accepted</span>
	      						@endif
	      					</td>
	      					<td>
	      						@if(isset($item->is_completed))
                                    @if($item->is_completed == 1)
                                          <span style="color: green;">Completed</span>
                                    @else
                                          <span style="color: red;">Not Completed</span>
                                    @endif
                              	@endif
	      					</td>
	      					<td>
	      						<a href="{{ url('restaurent-single-order/'.$item->id) }}" title="View Order">
	      							<button class="btn btn-sm btn-info">
	      								View
	      							</button>
	      						</a>
	      						@if($item->is_completed == 0)
		      						<a href="{{ url('restaurent-single-order-complete/'.$item->id) }}" title="View Order">
		      							<button class="btn btn-sm btn-success">
		      								Complete
		      							</button>
		      						</a>
	      						@endif
	      						<a href="{{ url('customer-review/'.$item->id.'/'.'Restaurant') }}" title="View Order">
	      							<button class="btn btn-sm btn-dark">
	      								Review
	      							</button>
	      						</a>
	      					</td>
	      				</tr>
      				@endforeach
      			</tbody>
      		</table>
      		@elseif($response->type == 'Worker')
      			<h4 class="text-center">{{ $response->type }}</h4>
	      		<hr>
	      		<hr>
	      		<table class="table table-bordered">
	      			<thead>
	      				<th>#</th>
	      				<th>Final Price(SAR)</th>
	      				<th>Estimated Time</th>
	      				<th>Is Completed?</th>
	      				<th>Actions</th>
	      			</thead>
	      			<tbody>
	      				@foreach($response->customer_orders as $item)
		      				<tr>
		      					<td>{{ $loop->iteration }}</td>
		      					<td>{{ $item->final_price }}</td>
		      					<td>{{ $item->estimated_time }}</td>
		      					<td>
		      						@if(isset($item->is_completed))
	                                    @if($item->is_completed == 1)
	                                          <span style="color: green;">Completed</span>
	                                    @else
	                                          <span style="color: red;">Not Completed</span>
	                                    @endif
	                              	@endif
		      					</td>
		      					<td>
		      						<a href="{{ url('worker-single-order/'.$item->id) }}" title="View Order">
		      							<button class="btn btn-sm btn-info">
		      								View
		      							</button>
		      						</a>
		      						@if($item->is_completed == 0)
			      						<a href="{{ url('worker-single-order-complete/'.$item->id) }}" title="View Order">
			      							<button class="btn btn-sm btn-success">
			      								Complete
			      							</button>
			      						</a>
			      					@endif
		      						<a href="{{ url('customer-review/'.$item->id.'/'.'Worker') }}" title="View Order">
		      							<button class="btn btn-sm btn-dark">
		      								Review
		      							</button>
		      						</a>
		      					</td>
		      				</tr>
	      				@endforeach
	      			</tbody>
	      		</table>
      		@else
      			<h4 class="text-center">{{ $response->type }}</h4>
	      		<hr>
	      		<hr>
	      		<table class="table table-bordered">
	      			<thead>
	      				<th>#</th>
	      				<th>Final Price(SAR)</th>
	      				<th>Estimated Time</th>
	      				<th>Actions</th>
	      			</thead>
	      			<tbody>
	      				@foreach($response->customer_orders as $item)
		      				<tr>
		      					<td>{{ $loop->iteration }}</td>
		      					<td>{{ $item->final_price }}</td>
		      					<td>{{ $item->estimated_time }}</td>
		      					<td>
		      						<a href="{{ url('store-single-order/'.$item->id) }}" title="View Order">
		      							<button class="btn btn-sm btn-info">
		      								View
		      							</button>
		      						</a>

		      						<a href="{{ url('customer-review/'.$item->id.'/'.'Store') }}" title="View Order">
		      							<button class="btn btn-sm btn-dark">
		      								Review
		      							</button>
		      						</a>
		      					</td>
		      				</tr>
	      				@endforeach
	      			</tbody>
	      		</table>
      		@endif
      	</div>
  </div>
</div>
@endsection
@section('front-additional-js')

@endsection