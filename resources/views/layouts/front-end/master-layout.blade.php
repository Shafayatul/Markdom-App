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


<input type="hidden" name="hidden-is-driver" id="hidden-is-driver" value="0">
{{-- driver modal --}}
<div class="hover_bkgr_fricc">
	<div class="container">       
		<span class="helper"></span>
		<div>  
			<div class="user-profile">
				<div class="offer-list">
					<div class="sent"> 
						<h4>Sent Offers</h4>
					</div>
					<span>11 Offers <strong class="one">1</strong></span>
				</div> 
				<div class="profile">           
					<img class="avatar" src="{{ asset('front-end-assets/images/user-profile.png') }}" alt="Ash" />               
					<div class="description">
						<h4 class="username">Name</h4> 
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star checked"></span>
						<span class="fa fa-star"></span>
						<span class="fa fa-star"></span>
					</div>  
				</div> 

				<ul class="data">
					<li>
						<span> 2.7km</span>
					</li>
					<li>
						<span>11.01 SAR</span>
					</li>
					<li>
						<span>1 hour</span>
					</li>
				</ul> 
				<form class="button-gruop">
					<input class="button " type="button" value="Cancel Order" name="">
					<input class="button " type="button" value="Accept offer" name="">
				</form>
			</div>
		</div>  
	</div>
</div>  

  {{-- @include('layouts.front-end.include.footer') --}}
</div>
@include('layouts.front-end.include.all-js')
@yield('front-additional-js')
</body>
</html>
