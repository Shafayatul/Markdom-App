@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-details.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
        <div class="restaurant-top-box" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
            <span class="restaurant-name">Store Name</span>
            <span class="store-rate-title">{{ __('content.store_rate') }}</span>
            <span class="store-rating">
                @for ($i=0; $i < 3; $i++) <i class="fa fa-star"></i>
                    @endfor
                    <i class="fa fa-star text-success"></i>
                    <i class="fa fa-star text-success"></i>
            </span>
        </div>
        <div class="restaurant-details-div">
            <h1 class="text-left">{{ __('content.store_details') }}</h1>
            <div class="restaurant-details-mother">
                <div class="restaurant-details-box">
                    <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                </div>
                <div class="restaurant-details-box">
                    <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                </div>
                <div class="restaurant-details-box">
                    <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                </div>
            </div> --}}

            <div class="sliding-category">
              <div class="slider-area slider">
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ asset('front-end-assets/images/b5.jpg') }}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
              </div>
            </div>

            <div class="product-div">
                <div id="grid">
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
                    </div>
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
                    </div>
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
                    </div>
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
                    </div>
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
                    </div>
                    <div class="product-box shadow">
                        <div class="product-image-box">
                          <img src="{{ asset('front-end-assets/images/bk1.jpg') }}" alt="">
                        </div>
                        <div class="product-name">
                          <h1 class="text-left">Product Name</h1>
                        </div>
                        <div class="price-button">
                          <p class="pull-left">Price</p>
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                        </div>
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
      slidesToScroll: 3,
      centerMode: true
  });
}else if ($(window).width() < 767) {
  $(".slider-area").slick({
      dots: false,
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 1,
      centerMode: true
  });
}else {
  $(".slider-area").slick({
      dots: false,
      infinite: true,
      slidesToShow: 5,
      slidesToScroll: 1,
      centerMode: true
  });
}
</script>
@endsection
