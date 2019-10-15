@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/restaurant-details.css') }}">
@endsection
@section('main-content')
<div class="restaurant text-center">
    <div class="container">
        <div class="restaurant-top-box" style="background-image: url('{{ asset(env('MAIN_HOST_URL').$store->preview_image) }}');">
            <span class="restaurant-name">
                @if(app()->getLocale() == 'en')
                    {{ $store->name }}
                @else
                    {{ $store->name_arabic }}
                @endif
            </span>
            <span class="store-rate-title">{{ __('content.store_rate') }}</span>
            <span class="store-rating">
                @for ($i=0; $i < $review; $i++)
                  <i class="fa fa-star"></i>
                @endfor
                @for ($i=5; $i > $review; $i--)
                  <i class="fa fa-star text-success"></i>
                @endfor
            </span>
        </div>
        <div class="restaurant-details-div">
            <h1 class="text-left">{{ __('content.restuarent_details') }}</h1>
            <div class="text-left single-store-description">
                @if(app()->getLocale() == 'en')
                    {{ $store->description }}
                @else
                    {{ $store->arabic_description }}
                @endif
            </div>
            <h1 class="text-left">{{ __('content.menu') }}</h1>
            <div class="restaurant-details-mother">
                @foreach($products as $product)
                <div class="restaurant-details-box">
                    <a href="#">
                        <img src="{{ asset($product->preview_image) }}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            <div class="store-location">
                <p class="text-left">
                    @if(app()->getLocale() == 'en')
                        {{ $store->location }}
                    @else
                        {{ $store->arabic_location }}
                    @endif
                </p>
                <p class="text-left">2.05 Km</p>
            </div>
            <div class="store-status text-left">
                <i class="fa fa-circle online"></i>
                <span class="store-status-text">
                    @if($is_available)
                      @lang('content.store_is_open')
                    @else
                      @lang('content.store_is_closed')
                    @endif
                </span>
            </div>
            <div class="order-button text-center">
                <a href="{{ route('order-details', ['user_id' => Auth::id(), 'store_id' => $store->id]) }}">
                    <button class="btn btn-success btn-block" type="button" name="button">
                        <p>Order Now</p>
                        <p class="badge badge-light">100% off</p> on delivery up to 10.0 SAR
                    </button>
                    
                </a> 
        {{-- <a href="#" id="order-place-by-customer">
            <button class="btn btn-success btn-block" type="button" name="button">
                <p>Order Now</p>
                <p class="badge badge-light">100% off</p> on delivery up to 10.0 SAR
            </button>
            
        </a> --}}
        </div>
    </div>
</div>
</div>

{{-- <input type="hidden" id="hidden-user-id" name="hidden-user-id" value="{{ Auth::id() }}">
<input type="hidden" id="hidden-store-id" name="hidden-store-id" value="{{ $store->id }}">
<input type="hidden" id="hidden-lat" name="hidden-lat" value="{{ $store->lat }}">
<input type="hidden" id="hidden-lon" name="hidden-lon" value="{{ $store->lan }}"> --}}
{{-- <input type="hidden" id="hidden-redirect-url" value="{{ url() }}"> --}}

@endsection
@section('front-additional-js')
<script type="text/javascript">
</script>
@endsection
