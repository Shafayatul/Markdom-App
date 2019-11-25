@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/relocation-store-list.css') }}">
@endsection
@section('main-content')
<div class="restaurant text-center">
  <div class="container">
    <div class="sliding-category">
      <div class="slider-area slider">
        @foreach ($stores as $single_store)
          <div class="sliding-div">
            <a href="{{ route('select-location', ['id' => $single_store->id]) }}" class="sliding-div-a" >
              <div class="sliding-category-box shadow">
                <div class="sliding-category-img">
                  <img src="{{ env('MAIN_HOST_URL').$single_store->preview_image }}" alt="">
                </div>
              </div>
              <p class="sliding-category-name">
                @if(app()->getLocale() == 'en')
                  {{ $single_store->name }}
                @else
                  {{ $single_store->name_arabic }}
                @endif
              </p>
            </a>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
