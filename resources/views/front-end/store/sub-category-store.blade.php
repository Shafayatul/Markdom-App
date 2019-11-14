@extends('layouts.front-end.master-layout')

@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/sub-category-store.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
    <div class="container">
        <div class="sliding-category">
            <div class="slider-area slider">
                <div class="sliding-div show-all">
                    <div class="sliding-category-box">
                        <a href="#" class="sliding-category-box-a"> <span class="sliding-category-name">{{ __('content.all') }}</span> </a>
                    </div>
                </div>
                @foreach ($subCategories as $subCategory)
                <div class="sliding-div show-specific" sub-cat-id="{{ $subCategory->id }}">
                    <div class="sliding-category-box">
                        <a href="#" class="sliding-category-box-a"> <span class="sliding-category-name">{{ $subCategory->name }}</span> </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="rectangle-div">
            <div id="grid">
                @foreach ($stores as $store)
                <a href="{{ route('store-details', ['id' => $store->id]) }}" class="rectangle-box-a shadow media" store-sub-cat-id="{{ $store->sub_category_id }}">
                    <div class="rectangle-box ">
                        <div class="logo-box">
                            <img src="{{ asset(env('MAIN_HOST_URL').$store->preview_image) }}" alt="">
                        </div>
                        <div class="name-location-div">
                            @if(app()->getLocale() == 'en')
                                <span class="name text-right">{{ $store->name }}</span>
                                <span class="location text-right">{{ $store->location }}</span>
                            @else
                                <span class="name text-right">{{ $store->name_arabic }}</span>
                                <span class="location text-center">{{ $store->arabic_location }}</span>
                            @endif
                            <div class="kilometer-div text-center">
                                <span class="kilometer">2.05 KM</span>
                            </div>
                        </div>
                        
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        
    </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('.show-all').click(function() {
            $('.rectangle-box-a').show(500);
        });
        $('.show-specific').click(function() {
            $('.rectangle-box-a').hide(500);
            var subCatId = $(this).attr('sub-cat-id');
            $('.rectangle-box-a').each(function() {
                if ($(this).attr('store-sub-cat-id') == subCatId) {
                    $(this).show(500);
                }

            })
        });
    });

    // if ($(window).width() < 480) {
    //     $(".slider-area").slick({
    //         dots: false,
    //         infinite: true,
    //         slidesToShow: 3,
    //         slidesToScroll: 3
    //     });
    // } else if ($(window).width() < 767) {
    //     $(".slider-area").slick({
    //         dots: false,
    //         infinite: true,
    //         slidesToShow: 4,
    //         slidesToScroll: 1
    //     });
    // } else {
    //     $(".slider-area").slick({
    //         dots: false,
    //         infinite: true,
    //         slidesToShow: 5,
    //         slidesToScroll: 1
    //     });
    // }
</script>
@endsection
