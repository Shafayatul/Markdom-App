@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" type="text/css" href="{{ asset('front-end-assets/responsive-slider/responsiveslides.css')}}">
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-product-details.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
    <div class="container">
        <div class="main_slider">
            <div class="fill_height">
                <div class="sliding_box">
                    <ul class="rslides" id="slider1">
                      <?php
                        $multiple_image   = $product_details->multiple_images;
                        $multiple_images  = explode(",",$multiple_image);
                      ?>
                      @foreach ($multiple_images as $single_image)
                        <li><img src="{{ env('MAIN_HOST_URL').$single_image}}" alt=""></li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-details">
          <div class="product-title">
            <div class="left text-left">
              <p>
                @if(app()->getLocale() == 'en')
                  {{ $product_details->name }}
                @else
                  {{ $product_details->name_arabic }}
                @endif
              </p>
            </div>
            <div class="right text-right"> <p>{{ $product_details->price }}</p></div>
          </div>
          <div class="product-description">
            <div class="left text-left">
              <p>
                @if(app()->getLocale() == 'en')
                  {{ $product_details->description }}
                @else
                  {{ $product_details->description_arabic }}
                @endif
              </p>
            </div>
            <div class="right text-right"> <p>
              @for ($i=0; $i <5; $i++)
                <i class="fa fa-star"></i>
              @endfor
            </p>
          </div>
          </div>
        </div>
        <div class="stock">
          <p>only 10 pcs available</p>
        </div>

        <div class="add-cart-button-div">
          <button class="btn btn-success add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button>
        </div>
    </div>
</div>
@endsection

@section('front-additional-js')
<script src="{{ asset('front-end-assets/responsive-slider/responsiveslides.min.js')}}"></script>
<script type="text/javascript">
  $(function () {
  // Slideshow 1
      $("#slider1").responsiveSlides({
        maxwidth: 1124,
        speed: 800,
      });
  });
</script>
@endsection
