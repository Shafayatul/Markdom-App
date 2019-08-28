@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/css/restaurant.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Sohan</p>
          </div>
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Muhammad</p>
          </div>
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Sohan</p>
          </div>
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Hossain</p>
          </div>
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Sharafat</p>
          </div>
          <div class="sliding-div">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Shayafat</p>
          </div>
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
        <div class="rectangle-box shadow">
          <span class="title">Store Name</span>
          <span class="number">150 SR</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">
    $(".slider-area").slick({
        dots: false,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1
    });
</script>
@endsection
