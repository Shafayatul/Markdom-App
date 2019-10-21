@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/sub-category-worker.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container sliding-container">
    <div class="sliding-category">
      <div class="slider-area slider">
          <div class="sliding-div">
            <div class="active sliding-category-box">
              <a href="#" class=" sliding-category-box-a show-all "> <span class=" sliding-category-name">{{ __('content.all') }}</span> </a>
            </div>
          </div>
          @foreach ($subCategories as $subCategory)
            <div class="sliding-div show-specific" sub-cat-id="{{ $subCategory->id }}">
              <div class="sliding-category-box">
                <span class="sliding-category-name">
                  @if(app()->getLocale() == 'en')
                    {{ $subCategory->name }}
                  @else
                    {{ $subCategory->name_arabic }}
                  @endif
                </span>
              </div>
            </div>
          @endforeach
      </div>
    </div>
    <div class="rectangle-div">
      <div id="grid">

        
          <div class="rectangle-box shadow">
            <div class="name-location-div"> 
              <table class="table" style="display:block;" cellpadding="2">             
                    <tbody>
                      @foreach($stores as $store)
                      <a href="{{ route('worker-details', ['id' => $store->id]) }}" class="#" store-sub-cat-id="{{ $store->sub_category_id }}" style="">
                      <tr class="table-row">
                        <td width="15%"> 
                          <img src="{{ asset('front-end-assets/images/burger3.jpg') }}" alt="" width="100%" class="img-fluid rounded shadow-sm"> 
                        </td>
                        <th width="15%">
                          <div class="p-2">                            
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0"> 
                                <a href="{{ route('worker-details', ['id' => $store->id]) }}" class="text-dark d-inline-block align-middle">{{ $store->name }}</a>
                              </h5>
                                 <span  style="font-size: 8px;color: #E4E3E4;">Timex Unisex Originals</span> 
                            </div>
                          </div>
                        </th>
                        
                        <td width="15%" class="align-middle my">
                          <div class="offer" >
                            <a>25% off</a>
                          </div>
                        </td>
                        <td width="15%" class="align-middle price">
                          <strong>79.00</strong><br>
                          <span style="font-size:8px;color: #E4E3E4;">km</span> 
                        </td>                 
                      </tr>
                      </a>
                      @endforeach  
                    </tbody>
                  </table>
                  
                </div> 
             
            </div>
            <!-- <div class="kilometer-div">
              <span class="kilometer">2.05 KM</span>
            </div> -->
         
        
        {{-- <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        <a href="{{ url('worker-details') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
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
        slidesToShow: 4,
        slidesToScroll: 4
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
