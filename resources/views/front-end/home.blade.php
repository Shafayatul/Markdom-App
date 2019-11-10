@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/search-box.css') }}">
  <link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/new-home.css') }}">
@endsection
@section('main-content')
  <div class="content">



    <div class="menu-category">
      <div class="menu-area ">
        @foreach ($models as $model)
          <?php $url_link = strtolower($model->name); ?>
          <div class="sliding-div">
            <a href="{{ url('/'.$url_link) }}" class="sliding-div-a" >
              <div class="menu-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ asset(env('MAIN_HOST_URL').$model->preview_image) }}" alt="">
                </div>
              </div>
              @if(app()->getLocale() == 'en')
                <p class="sliding-category-name">{{ $model->name }}</p>
              @else
                <p class="sliding-category-name">{{ $model->name_arabic }}</p>
              @endif
            </a>
          </div>
        @endforeach
      </div>
    </div>

    <div class="hr-line"></div>

    <div class="rectangle-div">
      <div id="grid">
        @foreach($offers as $offer)
       
          <div class="rectangle-box shadow" style="background-image: url('{{ asset(env('MAIN_HOST_URL').$offer->preview_image) }}');"> 
            <a href="{{ url('store-product-details/'.$offer->id) }}">
            <span class="title">{{ $offer->name }}</span>
            <span class="title-2">Price: {{ $offer->price }}</span>
            @if($offer->offer_type == 'Amount')
              <span class="number">Offer Amount: {{ $offer->offer_amount }}</span>
            @else
              <span class="number">Offer Percent: {{ $offer->offer_percent }}%</span>
            @endif
            </a>
          </div>
        @endforeach

      </div>
    </div>


  </div>
@endsection

@section('front-additional-js')
  <script type="text/javascript">
  $(window).load(function() {
   $("#flexiselDemo3").flexisel({
     visibleItems:1,
     animationSpeed: 1000,
     autoPlay: true,
     autoPlaySpeed: 5000,
     pauseOnHover: true,
     enableResponsiveBreakpoints: true,
     responsiveBreakpoints: {
       portrait: {
         changePoint:480,
         visibleItems:1
       },
       landscape: {
         changePoint:640,
         visibleItems:1
       },
       tablet: {
         changePoint:768,
         visibleItems:1
       }
     }
   });

  });
  </script>
<script>

    $(document).ready(function () {
      var mySelect = $('#first-disabled2');

      $('#special').on('click', function () {
        mySelect.find('option:selected').prop('disabled', true);
        mySelect.selectpicker('refresh');
      });

      $('#special2').on('click', function () {
        mySelect.find('option:disabled').prop('disabled', false);
        mySelect.selectpicker('refresh');
      });

      $('#basic2').selectpicker({
        liveSearch: true,
        maxOptions: 1
      });

      $( '.uls-trigger' ).uls( {
        onSelect : function( language ) {
          var languageName = $.uls.data.getAutonym( language );
          $( '.uls-trigger' ).text( languageName );
        },
        quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr'] //FIXME
      } );

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
            slidesToScroll: 1
        });
      }

      if ($(window).width() < 550 ) {
        $(".slider-area-2").slick({
            dots: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true
        });
      }else if ($(window).width() < 767) {
        $(".slider-area-2").slick({
            dots: false,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            centerMode: true
        });
      }else {
        $(".slider-area-2").slick({
            dots: false,
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            centerMode: true
        });
      }
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      $.ajax({
             type:'POST',
             url:'{{ url("/ajax-is-driver") }}',
             success:function(data){
                console.log('fffffff'+data);
                $(".hidden-is-driver").val(data.is_driver);
             }
          });
    });

  </script>



@endsection
