@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/sub-sub-category-worker.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">{{ __('content.all') }}</span>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Per Marker</span>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Restaurants</span>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Gifts</span>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Workers</span>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Gifts</span>
            </div>
          </div>
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
        <a href="{{ route('worker-service-delivery') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Service Name</span>
              <span class="location">Service Price</span>
            </div>
            <div class="kilometer-div">
              {{-- <span class="kilometer">2.05 KM</span> --}}
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">
  if ($(window).width() < 480 ) {
    $(".slider-area").slick({
        dots: false,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
  }else if ($(window).width() < 767) {
    $(".slider-area").slick({
        dots: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
  }else {
    $(".slider-area").slick({
        dots: false,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1
    });
  }

</script>
@endsection
