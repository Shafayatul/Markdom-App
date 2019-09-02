@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Muhammad</p>
            </a>
          </div>
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Sharafat</p>
            </a>
          </div>
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Hossain</p>
            </a>
          </div>
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Sohan</p>
            </a>
          </div>
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Shayafat</p>
            </a>
          </div>
          <div class="sliding-div">
            <a href="{{ route('sub-category-worker') }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">Haque</p>
            </a>
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
