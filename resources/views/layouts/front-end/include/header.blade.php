{{-- <div class="header"> --}}
    {{-- <div class="logo">
      <a href="{{ url('/') }}"><span>Mkh</span>dom</a>
    </div>
    <div class="header-right">
      <a class="account" href="login.html">Restorant</a>
      <a class="account" href="login.html">Workers</a>
      <a class="account" href="login.html">Store</a>
      <a class="account" href="login.html">Login</a>

      <span class="hamburger"><i class="fa fa-bars"></i></span>
      <span class="hamburger-close"><i class="fa fa-close"></i></span>
      <div class="main-menu">
        <ul class="main-ul">
          <li class="main-li"> <a href="{{ route('restaurant') }}" class="main-li-a">Restorant</a></li>
          <li class="main-li"> <a href="{{ route('store') }}" class="main-li-a">Store</a></li>
          <li class="main-li"> <a href="{{ route('worker') }}" class="main-li-a">Workers</a></li>
          <li class="main-li main-li-dropdown"> <a class="main-li-a">My account <span class="drop-down-menu"><i class="fa fa-caret-down"></i></span></a>
            <ul class="sub-ul">
              <li class="sub-li"> <a href="{{ route('user-login') }}" class="sub-li-a">Login</a></li>
              <li class="sub-li"> <a href="{{ route('user-signup') }}" class="sub-li-a">Signup</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div> --}}

    {{-- <div class="body-wrap"> --}}
      <div class="container">
        <nav class="navbar navbar-inverse" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <div class="logo">
                <a href="{{ url('/') }}"><span>Mkh</span>dom</a>
              </div>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('restaurant') }}">Restorant</a></li>
                <li><a href="{{ route('store') }}" class="main-li-a">Store</a></li>
                <li><a href="{{ route('worker') }}" class="main-li-a">Workers</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">My account <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('user-login') }}">Login</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('user-signup') }}" class="sub-li-a">Signup</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    {{-- </div> --}}

{{-- </div> --}}
