@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-details.css') }}">
@endsection

@section('main-content')
<div class="worker text-center">
  <div class="container">
    <div class="worker-image-div">
      <div class="worker-image-box shadow">
        <img src="{{ asset(env('MAIN_HOST_URL').$store->preview_image) }}" alt="">
      </div>
    </div>
    <div class="review">
      <span class="store-rating">
        @for ($i=0; $i < $review; $i++)
        <i class="fa fa-star"></i>
        @endfor
        @for ($i=5; $i > $review; $i--)
        <i class="fa fa-star text-success"></i>
        @endfor
      </span>
    </div>
    <div class="rectangle-div">
      <div id="grid">
        @foreach($service_categories as $service_category)
        <a href="{{ route('service-sub-category-worker', ['id' => $service_category->id]) }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">
               @if(app()->getLocale() == 'en')
                  <span class="name">{{ $service_category->name }}</span>
                @else
                  <span class="name">{{ $service_category->name_arabic }}</span>
                @endif
            </span>
            {{-- <span class="number">150 SR</span> --}}
          </div>
        </a>
        @endforeach

        {{-- <a href="{{ url('sub-sub-category-worker') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">Sub Category</span>
            <span class="number">150 SR</span>
          </div>
        </a>
        <a href="{{ url('sub-sub-category-worker') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">Sub Category</span>
            <span class="number">150 SR</span>
          </div>
        </a>
        <a href="{{ url('sub-sub-category-worker') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">Sub Category</span>
            <span class="number">150 SR</span>
          </div>
        </a>
        <a href="{{ url('sub-sub-category-worker') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">Sub Category</span>
            <span class="number">150 SR</span>
          </div>
        </a>
        <a href="{{ url('sub-sub-category-worker') }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
          <div class="rectangle-box shadow">
            <span class="title">Sub Category</span>
            <span class="number">150 SR</span>
          </div>
        </a> --}}
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
