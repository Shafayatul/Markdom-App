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
  <h4>Drop Off Location</h4>
  <hr>
  <div class="container">
      <div id="map"></div>
  </div>
  <br/>
<a href="{{ route('select-location-final-step') }}" class="btn btn-lg btn-success btn-block">Next</a>
  </div>
</div>
@endsection

@section('front-additional-js')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzC94pnwIAUI5G3HQKxFCnFBiDiHIIfJk&sensor=false"></script>
    <script>
        var map;
        function initMap1() {
            var center = {lat: 24.774265, lng: 46.738586} ;
            var opts = { 'center': center, 'zoom': 15, 'mapTypeId': google.maps.MapTypeId.ROADMAP }
                map = new google.maps.Map(document.getElementById('map'), opts);
                var marker = new google.maps.Marker({position: center, draggable:true, map: map});
              google.maps.event.addListener(marker,'click',function(event) {
               var  lat2 = event.latLng.lat().toFixed(6);
               var  lng2 = event.latLng.lng().toFixed(6);
               console.log(lat2);
               console.log(lng2);
                 window.localStorage.setItem('lat2', lat2);
                 window.localStorage.setItem('lng2', lng2);
              });
        } 
        google.maps.event.addDomListener(window, 'load', initMap1);
    </script>

@endsection
