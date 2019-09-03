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
                        <li><img src="{{ asset('front-end-assets/responsive-slider/1.jpg') }}" alt=""></li>
                        <li><img src="{{ asset('front-end-assets/responsive-slider/2.jpg') }}" alt=""></li>
                        <li><img src="{{ asset('front-end-assets/responsive-slider/3.jpg') }}" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-details">
          <div class="product-title">
            <div class="left text-left"> <p>Product Name</p></div>
            <div class="right text-right"> <p>Product Price</p></div>
          </div>
          <div class="product-description">
            <div class="left text-left"> <p>Product Description Text</p></div>
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
          <button class="btn btn-success add-cart-button" type="button" name="button">Add Cart</button>
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
