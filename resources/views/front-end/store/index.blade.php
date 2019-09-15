@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
        @foreach ($categories as $single_category)
          <div class="sliding-div">
            <a href="{{ url('sub-category-store/'.$single_category->id) }}" class="sliding-div-a" >
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ env('MAIN_HOST_URL').$single_category->image }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">{{ $single_category->name }}</p>
            </a>
          </div>
        @endforeach
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        @foreach ($categories_offer as $single_categories_offer)
          <div class="rectangle-box shadow" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <span class="title">{{ $single_categories_offer->title }}</span>
          <span class="number">
            @if ($single_categories_offer->amount != null)
              {{ $single_categories_offer->amount }}
            @else
              {{ $single_categories_offer->percentage }}
            @endif
          </span>
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
