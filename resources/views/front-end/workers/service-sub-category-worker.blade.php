@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/service-sub-category-worker.css') }}">
@endsection

@section('main-content')
<div class="restaurant text-center">
  <div class="container">
     <div class="rectangle-div">
      <div id="grid">
        @foreach($service_sub_categories as $service_sub_category)
          <a href="{{ route('service-sub-sub-by-service-sub-category', ['id' => $service_sub_category->id]) }}" class="rectangle-box-a" style="background-image: url('{{ asset('front-end-assets/images/b11.jpg') }}');">
            <div class="rectangle-box shadow">
              <span class="title">
                 @if(app()->getLocale() == 'en')
                    <span class="name">{{ $service_sub_category->name }}</span>
                  @else
                    <span class="name">{{ $service_sub_category->name_arabic }}</span>
                  @endif
              </span>
              {{-- <span class="number">150 SR</span> --}}
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

</script>
@endsection
