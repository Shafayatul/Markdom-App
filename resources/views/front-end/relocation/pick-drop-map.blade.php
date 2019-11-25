@extends('layouts.front-end.master-layout')
@section('front-additional-css')
<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    height: 70vh;
    width: 100%;
    /*position: unset !important;*/
  }
  /* Optional: Makes the sample page fill the window. */
 /* html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }*/
</style>
@endsection
@section('main-content')
<div class="restaurant text-center">
  <h4>Pickup Location</h4>
  <hr>
  <div class="container">
      <div id="map"></div>
      <input type="hidden" name="store_id" id="store_id" value="{{ $id }}">
  </div>
  <br/>
<a href="{{ route('select-location-step-two') }}" class="btn btn-lg btn-success btn-block">Next</a>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzC94pnwIAUI5G3HQKxFCnFBiDiHIIfJk&sensor=false"></script>
    <script>
         var store_id = document.getElementById("store_id").value;
         window.localStorage.setItem('store_id', store_id);
        var map;
        function initMap() {
            var center = {lat: 24.774265, lng: 46.738586} ;
            var opts = { 'center': center, 'zoom': 15, 'mapTypeId': google.maps.MapTypeId.ROADMAP }
                map = new google.maps.Map(document.getElementById('map'), opts);
                var marker = new google.maps.Marker({position: center, draggable:true, map: map});
              google.maps.event.addListener(marker,'click',function(event) {
               var  lat1 = event.latLng.lat().toFixed(6);
               var  lng1 = event.latLng.lng().toFixed(6);
               console.log(lat1);
               console.log(lng1);
                 window.localStorage.setItem('lat1', lat1);
                 window.localStorage.setItem('lng1', lng1);
              });

        } 
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>

@endsection
