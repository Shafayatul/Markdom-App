@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-details.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
    <div class="container">
        <div class="restaurant-top-box">
            <span class="restaurant-name">Store Name</span>
            <span class="store-rate-title">Store Rate</span>
            <span class="store-rating">
                @for ($i=0; $i < 3; $i++) <i class="fa fa-star"></i>
                    @endfor
                    <i class="fa fa-star text-success"></i>
                    <i class="fa fa-star text-success"></i>
            </span>
        </div>
        <div class="restaurant-details-div">
            <h1 class="text-left">Store Details</h1>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
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
                          <button class="btn btn-success pull-right add-cart-button" type="button" name="button">Add Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
