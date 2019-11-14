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
            <div class="restaurant-details-body">
            <h1 class="text-left">{{ __('content.restuarent_details') }}</h1>
            <div class="text-left single-store-description">
                <p>
                    @if(app()->getLocale() == 'en')
                        {{ $store->description }}
                    @else
                        {{ $store->arabic_description }}
                    @endif
                </p>
            </div>
            <h1 class="text-left">{{ __('content.menu') }}</h1>
            {{-- <div class="restaurant-details-mother">
                @foreach($products as $product)
                <div class="restaurant-details-box">
                    <a href="#">
                        <img src="{{ asset(env('MAIN_HOST_URL').$product->preview_image) }}" alt="">
                    </a>
                </div>
                @endforeach
            </div> --}}
            <div class="restaurant-details-mother">
                @foreach($products as $product)
                <div class="restaurant-details-box">
                    <a href="#lightbox" data-toggle="modal" data-slide-to="0">
                        <img src="{{ asset(env('MAIN_HOST_URL').$product->preview_image) }}" alt="">
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
            </div>


            <div class="container">
              {{-- <ul class="nav nav-pills nav-stacked">
                <li><a href="#lightbox" >Open Lightbox</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="1">2nd Image</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="2">3rd Image</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="15">Open non existing Image</a></li>
              </ul>  --}}             
              <div class="modal fade and carousel slide" id="lightbox">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <ol class="carousel-indicators">
                        @foreach($products as $key => $product)
                        <li data-target="#lightbox" data-slide-to="{{ $key }}" class="active pick-item"></li>
                        @endforeach
                      </ol>
                      <div class="carousel-inner">
                    @foreach($products as $key => $product)
                        <div class="item {{$key == 0 ? 'active' : '' }}">
                          <div class="card" >
                              <img class="card-img-top rounded" src="{{ asset(env('MAIN_HOST_URL').$product->preview_image) }}" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-price">${{ $product->price }}</h5>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                
                              </div>
                            </div>
                        </div>
                    @endforeach
                      </div><!-- /.carousel-inner -->
                      <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div><!-- /.modal-body -->
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->

            </div><!-- /.container -->




            <div class="order-button text-center">
                <a href="{{ route('order-details', ['user_id' => $user->id, 'store_id' => $store->id]) }}">
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

@endsection
