<div class="header">
  <div class="container">
    <div class="logo">
      <a href="{{ url('/') }}"><span>Mkh</span>dom</a>
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
        <li class="main-li"> <a href="{{ route('store') }}" class="main-li-a">Store</a></li>
        <li class="main-li"> <a href="{{ route('worker') }}" class="main-li-a">Workers</a></li>
        <li class="main-li main-li-dropdown"> <a class="main-li-a">@lang('header.my_account') <span class="drop-down-menu"><i class="fa fa-caret-down"></i></span></a>
          <ul class="sub-ul">
            <li class="sub-li"> <a href="{{ route('user-login') }}" class="sub-li-a">@lang('header.login')</a></li>
            <li class="sub-li"> <a href="{{ route('user-signup') }}" class="sub-li-a">@lang('header.signup')</a></li>
          </ul>
        </li>
        <li class="main-li main-li-dropdown"> 
          <a class="main-li-a">
            {{ LaravelLocalization::getCurrentLocaleNative() }}
            <span class="drop-down-menu">
              <i class="fa fa-caret-down"></i>
            </span>
          </a>
          <ul class="sub-ul">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li class="sub-li">
                <a rel="alternate" class="sub-li-a" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
            @endforeach
          </ul>
        </li>
      </ul>
    </div>

  </div>
  </div>
</div>
