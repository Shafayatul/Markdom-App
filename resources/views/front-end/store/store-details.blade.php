@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/store-details.css') }}">
@endsection

@section('main-content')
<div class="store text-center">
        <div class="restaurant-top-box" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
            <span class="restaurant-name">
              @if(app()->getLocale() == 'en')
                <h1 class="text-left">{{ $stores_details->name }}</h1>
              @else
                <h1 class="text-left">{{ $stores_details->name_arabic }}</h1>
              @endif
            </span>
            <span class="store-rate-title">{{ __('content.store_rate') }}</span>
            <span class="store-rating">
                @for ($i=0; $i < 3; $i++) <i class="fa fa-star"></i>
                    @endfor
                    <i class="fa fa-star text-success"></i>
                    <i class="fa fa-star text-success"></i>
            </span>
        </div>
        <?php
          $multiple_image   = $stores_details->multiple_images;
          $multiple_images  = explode(",",$multiple_image);
        ?>
          <div class="restaurant-details-div">
            <h1 class="text-left">{{ __('content.store_details') }}</h1>
            <div class="menu-category">
              <div class="slider menu-area">
                @foreach ($multiple_images as $key => $single_image)
                  <div class="sliding-div">
                    <a href="#lightbox" data-toggle="modal" data-slide-to="{{ $key }}" class="sliding-div-a" >
                      <div class="sliding-category-box">
                        <div class="sliding-category-img">
                          <img src="{{ env('MAIN_HOST_URL').$single_image}}" alt="">
                        </div>
                      </div>
                    </a>

                  </div>
                @endforeach

              </div>
            </div>
              <div class="container">
              {{-- <ul class="nav nav-pills nav-stacked">
                <li><a href="#lightbox" >Open Lightbox</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="1">2nd Image</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="2">3rd Image</a></li>
                <li><a href="#lightbox" data-toggle="modal" data-slide-to="15">Open non existing Image</a></li>
              </ul>  --}}             
              <div class="modal fade and carousel slide" id="lightbox">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <ol class="carousel-indicators">
                        @foreach ($multiple_images as $key => $single_image)
                        <li data-target="#lightbox" data-slide-to="{{ $key }}" class="active"></li>
                         @endforeach
                        {{-- <li data-target="#lightbox" data-slide-to="1"></li>
                        <li data-target="#lightbox" data-slide-to="2"></li> --}}
                      </ol>
                      <div class="carousel-inner">
                        @foreach ($multiple_images as $key => $single_image)
                        <div class="item {{$key == 0 ? 'active' : '' }}">
                          <div class="card" >
                              <img class="card-img-top rounded" src="{{ env('MAIN_HOST_URL').$single_image}}" alt="Card image cap">
                              <div class="card-body">
                               {{-- < h5 class="card-price">$45</h5>
                                <h5 class="card-title">product Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                                
                              </div>
                            </div>
                        </div>
                        @endforeach

                        {{-- <div class="item">
                            <div class="card" >
                              <img class="card-img-top rounded" src="{{ env('MAIN_HOST_URL').$single_image}}" alt="Card image cap">
                              <div class="card-body">
                                 <h5 class="card-price">$45</h5>
                                <h5 class="card-title">product Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                
                              </div>
                            </div>
                           
                        </div>
                        <div class="item">
                          <div class="card" >
                              <img class="rounded card-img-top" src="{{ env('MAIN_HOST_URL').$single_image}}" alt="Card image cap">
                              <div class="card-body">
                                 <h5 class="card-price">$45</h5>
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                
                              </div>
                            </div>
                        </div> --}}
                      </div><!-- /.carousel-inner -->
                      <a class="left carousel-control" href="#lightbox" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                      </a>
                      <a class="right carousel-control" href="#lightbox" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                      </a>
                    </div><!-- /.modal-body -->
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->

            </div><!-- /.container -->
            <div class="product-div">
                <div id="grid">
                  @foreach ($product_details as $product)
                      <div class="product-box shadow">
                        <a  href="{{ route('store-product-details', ['id'=>$product->id]) }}" class="rectangle-box-a">
                          <div class="product-image-box">
                            <img src="{{ env('MAIN_HOST_URL').$product->preview_image}}" alt="">
                          </div>
                          <div class="product-name">
                            @if(app()->getLocale() == 'en')
                              <h1 class="text-right">{{ $product->name }}</h1>
                            @else
                              <h1 class="text-right">{{ $product->name_arabic }}</h1>
                            @endif
                               <div class="price-button">
                            <p class="pull-right">{{ $product->price }}</p>
                          </div>
                          </div>
                         
                        </a>
                        <a class="row order-now text-center" href="{{ route('add-to-cart-store', ['id' => $product->id]) }}"><button class="btn btn-success add-cart-button" type="button" name="button">{{ __('content.add_cart') }}</button></a>
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
      slidesToScroll: 1,
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
      slidesToScroll: 1,
  });
}
</script>
@endsection
