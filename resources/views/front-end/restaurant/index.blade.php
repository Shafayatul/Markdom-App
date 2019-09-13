@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/restaurant.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
    <div class="sliding-category">
      <div class="slider-area slider">
        @foreach($categories as $category)
          <div class="sliding-div">
            <a href="{{ route('sub-category-restaurant', ['id'=>$category->id]) }}" class="sliding-div-a">
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset($category->image) }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">
                @if(app()->getLocale() == 'en')
                  {{ $category->name }}
                @else
                  {{ $category->name_arabic }}
                @endif
              </p>
            </a>
          </div>
        @endforeach
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        @foreach($offers as $offer)
          <div class="rectangle-box shadow" style="background-image: url('{{ asset($offer->image) }}');">
            <span class="title">
              @if(app()->getLocale() == 'en')
                {{ $offer->title }}
              @else
                {{ $offer->title_arabic }}
              @endif
            </span>
            <span class="number">
              @if($offer->is_amount == 1)
                {{ $offer->amount }} SR
              @else
                {{ $offer->percentage }}%
              @endif
            </span>
          </div>
        @endforeach
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
        slidesToShow: 4,
        slidesToScroll: 1
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
