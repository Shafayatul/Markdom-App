@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-details.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
        <div class="restaurant-top-box" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
            <span class="restaurant-name">
              @if(app()->getLocale() == 'en')
                <h1 class="text-left">{{ $stores_details->name }}</h1>
              @else
                <h1 class="text-left">{{ $stores_details->name_arabic }}</h1>
              @endif
            </span>
            <span class="store-rate-title">{{ __('content.store_rate') }}</span>
            <span class="store-rating">
                @for ($i=0; $i < 3; $i++) <i class="fa fa-star"></i>
                    @endfor
                    <i class="fa fa-star text-success"></i>
                    <i class="fa fa-star text-success"></i>
            </span>
        </div>
        <?php
          $multiple_image   = $stores_details->multiple_images;
          $multiple_images  = explode(",",$multiple_image);
        ?>
          <div class="restaurant-details-div">
            <h1 class="text-left">{{ __('content.store_details') }}</h1>
            <div class="sliding-category">
              <div class="slider-area slider">
                @foreach ($multiple_images as $single_image)
                  <div class="sliding-div">
                    <a href="" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ env('MAIN_HOST_URL').$single_image}}" alt="">
                        </div>
                      </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="product-div">
                <div id="grid">
                  @foreach ($product_details as $product)
                      <div class="product-box shadow">
                        <a href="{{ route('store-product-details', ['id'=>$product->id]) }}" class="rectangle-box-a">
                          <div class="product-image-box">
                            <img src="{{ env('MAIN_HOST_URL').$product->preview_image}}" alt="">
                          </div>
                          <div class="product-name">
                            @if(app()->getLocale() == 'en')
                              <h1 class="text-left">{{ $product->name }}</h1>
                            @else
                              <h1 class="text-left">{{ $product->name_arabic }}</h1>
                            @endif
                          </div>
                          <div class="price-button">
                            <p class="pull-left">{{ $product->price }}</p>
                          </div>
                        </a>
                        <button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
                      </div>
                  @endforeach
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
      slidesToScroll: 1,
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
  });
}
</script>
@endsection
