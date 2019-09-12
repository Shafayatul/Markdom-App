@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/sub-category-restaurant.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
          <div class="sliding-div">
            <div class="sliding-category-box">
              <a href="#" class="sliding-category-box-a show-all"> <span class="sliding-category-name">All</span> </a>
            </div>
          </div>
          @foreach($sub_categories as $sub_category)
          <div class="sliding-div show-specific" sub-cat-id="{{ $sub_category->id }}">
            <div class="sliding-category-box">
              <span class="sliding-category-name">
                @if(app()->getLocale() == 'en')
                  {{ $sub_category->name }}
                @else
                  {{ $sub_category->name_arabic }}
                @endif
              </span>
            </div>
          </div>
          @endforeach
{{--           <div class="sliding-div">
            <div class="sliding-category-box">
              <a href="#" class="sliding-category-box-a"> <span class="sliding-category-name">Per Marker</span> </a>
            </div>
          </div>
          <div class="sliding-div">
            <div class="sliding-category-box">
              <span class="sliding-category-name">Gifts</span>
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
          </div> --}}
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        @foreach($stores as $store)
        <a href="{{ route('restaurant-details', ['id' => $store->id]) }}" class="rectangle-box-a" store-sub-cat-id="{{ $store->sub_category_id }}">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset($store->preview_image) }}" alt="">
            </div>
            <div class="name-location-div">
                @if(app()->getLocale() == 'en')
                  <span class="name">{{ $store->name }}</span>
                  <span class="location">{{ $store->location }}</span>
                @else
                  <span class="name">{{ $store->name_arabic }}</span>
                  <span class="location">{{ $store->arabic_location }}</span>
                @endif
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a>
        @endforeach
{{--         <a href="{{ route('restaurant-details') }}" class="rectangle-box-a">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Store Name</span>
              <span class="location">Store Best Location</span>
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a>
        <a href="{{ route('restaurant-details') }}" class="rectangle-box-a">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Store Name</span>
              <span class="location">Store Best Location</span>
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a>
        <a href="{{ route('restaurant-details') }}" class="rectangle-box-a">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Store Name</span>
              <span class="location">Store Best Location</span>
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a>
        <a href="{{ route('restaurant-details') }}" class="rectangle-box-a">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Store Name</span>
              <span class="location">Store Best Location</span>
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a>
        <a href="{{ route('restaurant-details') }}" class="rectangle-box-a">
          <div class="rectangle-box shadow">
            <div class="logo-box">
              <img src="{{ asset('front-end-assets/images/client_4.jpg') }}" alt="">
            </div>
            <div class="name-location-div">
              <span class="name">Store Name</span>
              <span class="location">Store Best Location</span>
            </div>
            <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div>
          </div>
        </a> --}}
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

  $(document).ready(function(){
    $('.show-all').click(function(){
      $('.rectangle-box-a').show(500);
    });
    $('.show-specific').click(function(){
      $('.rectangle-box-a').hide(500);
      var subCatId = $(this).attr('sub-cat-id');
      $('.rectangle-box-a').each(function(){
        if ($(this).attr('store-sub-cat-id') == subCatId) {
          $(this).show(500);
        }
        
      })
    });
    
  });


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
