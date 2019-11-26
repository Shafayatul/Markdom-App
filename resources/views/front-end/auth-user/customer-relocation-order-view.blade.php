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
      		<table class="table table-bordered">
      			<thead>
      				<th>#</th>
      				<th>Store</th>
      				<th>Car Type</th>
      				<th>Price</th>
      				<th>Status</th>
      				<th>Actions</th>
      			</thead>
      			<tbody>
      				@foreach($response->relocation_orders as $item)
	      				<tr>
	      					<td>{{ $loop->iteration }}</td>
	      					<td>
	      						@if(isset($stores[$item->store_id]))
	      							{{ $stores[$item->store_id] }}
	      						@endif
	      					</td>
	      					<td>
	      						@if(isset($cartypes[$item->car_type_id]))
	      							{{ $cartypes[$item->car_type_id] }}
	      						@endif
	      					</td>
	      					<td>
	      						{{ $item->price }}
	      					</td>
	      					<td>
	      						@if($item->status == 0)
                                    <span class="text-danger">Pending</span>
                                @else
                                    <span class="text-success">Confirmed</span>
                                @endif
	      					</td>
	      					<td>
	      							<a href="{{ url('relocation-single-order/'.$item->id) }}" title="View Order">
		      							<button class="btn btn-sm btn-info">
		      								View
		      							</button>
		      						</a>

		      						
		      						@if($item->status == 1)
		      							@if($item->payment_method == null)
			      							<a href="{{ url('relocation-address/'.$item->id) }}" title="View Order">
				      							<button class="btn btn-sm btn-info">
				      								Pay Now
				      							</button>
				      						</a>
			      						@endif
			      						<a href="{{ url('relocation-review/'.$item->id.'/'.'Relocation') }}" title="View Order">
			      							<button class="btn btn-sm btn-dark">
			      								Review
			      							</button>
			      						</a>
			      					@endif
	      					</td>
	      				</tr>
	      			@endforeach
      			</tbody>
      		</table>
      	</div>
  </div>
</div>
@endsection
@section('front-additional-js')

@endsection