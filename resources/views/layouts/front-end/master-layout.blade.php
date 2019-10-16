<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Resale a Business Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
@include('layouts.front-end.include.all-meta')
@include('layouts.front-end.include.all-css')
@yield('front-additional-css')
</head>
<body>
<div class="container">
  @include('layouts.front-end.include.header')
  @yield('main-content')


	@if(session()->has('is_driver') == '1')
	  <input type="hidden" name="hidden-is-driver" id="hidden-is-driver" value="1">
	@else
	  <input type="hidden" name="hidden-is-driver" id="hidden-is-driver" value="0">
	@endif

  {{-- @include('layouts.front-end.include.footer') --}}
</div>
@include('layouts.front-end.include.all-js')
@yield('front-additional-js')
</body>
</html>
