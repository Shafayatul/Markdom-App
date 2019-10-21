@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-details.css') }}">
@endsection

@section('main-content')
<div class="worker text-center">
  <div class="container">
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
      </div>
    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
