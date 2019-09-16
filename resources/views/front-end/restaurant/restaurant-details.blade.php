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
                    <a href="{{ route('order-details', ['id' => $product->id] ) }}">
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
                      @lang('content.Store is Open')
                    @else
                      @lang('content.Store is Closed')
                    @endif
                </span>
            </div>
            {{-- <div class="order-button text-center">
        <a href="{{ route('order-details') }}"><button class="btn btn-success" type="button" name="button">Order Menu</button></a>
        </div> --}}
    </div>
</div>
</div>
@endsection
@section('front-additional-js')
<script type="text/javascript">
</script>
@endsection
