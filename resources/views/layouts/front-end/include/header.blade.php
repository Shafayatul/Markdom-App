<div class="header">
  <div class="container">
    <div class="logo">
      <a href="index.html"><span>Re</span>sale</a>
    </div>
    <div class="header-right">
    {{-- <a class="account" href="login.html">Restorant</a>
    <a class="account" href="login.html">Workers</a>
    <a class="account" href="login.html">Store</a>
    <a class="account" href="login.html">Login</a> --}}

    <span class="hamburger"><i class="fa fa-bars"></i></span>
    <span class="hamburger-close"><i class="fa fa-close"></i></span>
    <div class="main-menu">
      <ul class="main-ul">
        <li class="main-li"> <a href="{{ route('restaurant') }}" class="main-li-a">Restorant</a></li>
        <li class="main-li"> <a href="#" class="main-li-a">Store</a></li>
        <li class="main-li"> <a href="{{ route('worker') }}" class="main-li-a">Workers</a></li>
        <li class="main-li main-li-dropdown"> <a class="main-li-a">My account <span class="drop-down-menu"><i class="fa fa-caret-down"></i></span></a>
          <ul class="sub-ul">
            <li class="sub-li"> <a href="{{ route('user-login') }}" class="sub-li-a">Login</a></li>
            <li class="sub-li"> <a href="{{ route('user-signup') }}" class="sub-li-a">Signup</a></li>
          </ul>
        </li>
      </ul>
    </div>

  </div>
  </div>
</div>
