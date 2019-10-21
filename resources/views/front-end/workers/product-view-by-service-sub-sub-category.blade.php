@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/product-view-worker.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
        <div class="sliding-div">
          <div class="sliding-category-box">
            <a href="#" class="sliding-category-box-a show-all"><span class="sliding-category-name">{{ __('content.all') }}</span></a>
          </div>
        </div>
        @foreach($service_sub_sub_categories as $item)
          <div class="sliding-div show-specific" service-sub-sub-cat-id="{{ $item->id }}">
            <div class="sliding-category-box">
              <span class="sliding-category-name">
                @if(app()->getLocale() == 'en')
                  {{ $item->name }}
                @else
                  {{ $item->name_arabic }}
                @endif
              </span>
            </div>
          </div>
        @endforeach
      </div>
    </div>


    <div class="restaurant-details-div">
      <div class="product-div">
          <div id="grid">
            @foreach ($services as $service)
                <div class="product-box shadow">
                  <a href="#" class="rectangle-box-a" service-sub-sub-category-id="{{ $service->service_sub_sub_category_id }}">
                    <div class="product-image-box">
                      <img src="{{ env('MAIN_HOST_URL').$service->preview_image}}" alt="">
                    </div>
                    <div class="product-name">
                      @if(app()->getLocale() == 'en')
                        <h1 class="text-left">{{ $service->name }}</h1>
                      @else
                        <h1 class="text-left">{{ $service->name_arabic }}</h1>
                      @endif
                    </div>
                    <div class="price-button">
                      <p class="pull-left">{{ $service->price }}</p>
                    </div>
                  </a>
                  <a href="{{ route('worker-product-details', ['id' => $service->id]) }}"><button class="btn btn-success pull-right add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button></a>
                </div>
            @endforeach
          </div>
      </div>
    </div>

      {{-- <div class="rectangle-div">
        <div id="grid">

          @foreach($services as $service)
          <a href="{{ route('worker-product-details', ['id' => $service->id]) }}" class="rectangle-box-a" style="background-image: url('{{ asset(env('MAIN_HOST_URL').$service->preview_image) }}');">
            <div class="rectangle-box shadow">
              <div class="name-location-div">
                <span class="name">
                  @if(app()->getLocale() == 'en')
                      <span class="name">{{ $service->name }}</span>
                    @else
                      <span class="name">{{ $service->name_arabic }}</span>
                    @endif
                </span>
                <span class="location">
                  {{ $service->price }}
                </span>
              </div>
            </div>
          </a>
          @endforeach
          
        </div>
      </div> --}}

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
      var serviceSubSubCatId = $(this).attr('service-sub-sub-cat-id');
      $('.rectangle-box-a').each(function(){
        if ($(this).attr('service-sub-sub-category-id') == serviceSubSubCatId) {
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
