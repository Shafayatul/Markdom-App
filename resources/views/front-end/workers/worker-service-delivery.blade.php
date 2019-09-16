@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-service-delivery.css') }}">
@endsection

@section('main-content')
<div class="worker text-center">
  <div class="container">
    <div class="delivery-option">
      @foreach($service_type_prices as $service_type_price)
      <a href="{{ route('worker-save-service-type', ['id' => $service_type_price->id]) }}">
        <div class="in-service">
          <h1 class="in-service-h1">
              @if(app()->getLocale() == 'en')
                  {{ $service_type_price->name }}
              @else
                {{ $service_type_price->name_arabic }}
              @endif
          </h1>
        </div>
      </a>
      @endforeach
      {{-- <a href="#">
        <div class="in-customer">
            <h1 class="in-customer-h1">{{ __('content.customer_place') }}</h1>
        </div>
      </a> --}}

    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
