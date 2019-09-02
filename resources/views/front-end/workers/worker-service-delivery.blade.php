@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<link rel="stylesheet" href="{{ asset('front-end-assets/custom-css/worker-service-delivery.css') }}">
@endsection

@section('main-content')
<div class="worker text-center">
  <div class="container">
    <div class="delivery-option">
      <a href="#">
        <div class="in-service">
          <h1 class="in-service-h1">In service provider shop</h1>
        </div>
      </a>
      <a href="#">
        <div class="in-customer">
            <h1 class="in-customer-h1">In customer place</h1>
        </div>
      </a>

    </div>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript">

</script>
@endsection
