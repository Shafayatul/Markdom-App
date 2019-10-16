@extends('layouts.front-end.master-layout')
@section('front-additional-css')
  <link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/search-box.css') }}">
  <link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/new-home.css') }}">
@endsection
@section('main-content')
  <div class="content">

    {{-- <div class="search-wrapper shadow">
      <div class="search-bar">
        <div class="search-icon search-icon-left">
          <i class="fa fa-search"></i>
        </div>
        <div class="search-field">
          <input class="search-field-input" type="text" maxLength="5" placeholder="Search Item"/>
        </div>
        <div class="search-icon search-icon-right">
          <i class="fa fa-filter"></i>
        </div>
      </div>
    </div> --}}

    {{-- <div class="hr-line"></div> --}}

    <div class="sliding-category">
      <div class="slider-area slider">
        @foreach ($models as $model)
          <?php $url_link = strtolower($model->name); ?>
          <div class="sliding-div">
            <a href="{{ url('/'.$url_link) }}" class="sliding-div-a" >
              <div class="sliding-category-box shadow">
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
        <div class="rectangle-box shadow" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <span class="title">Signature</span>
          <span class="title-2">Juices</span>
          <span class="number">Average</span>
          <span class="number-2">30-35 mins</span>
        </div>
        <div class="rectangle-box shadow" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <span class="title">Signature</span>
          <span class="title-2">Juices</span>
          <span class="number">Average</span>
          <span class="number-2">30-35 mins</span>
        </div>
      </div>
    </div>

    <div class="sliding-category-2">
      <div class="sliding-category-title">
        <h1 class="text-center">Featured On Carriage</h1>
      </div>
      <div class="slider-area-2 slider">
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
          <div class="sliding-div-2">
            <a href="#" class="sliding-div-2-a" >
              <div class="sliding-category-box-2">
                <div class="sliding-category-img-2">
                  <img src="{{ asset('front-end-assets/images/b11.jpg') }}" alt="">
                </div>
              </div>
            </a>
          </div>
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

    });

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

    $.ajax({

           type:'POST',

           url:'/ajax-is-driver',

           success:function(data){

              console.log(data);

           }

        });

  </script>



@endsection
