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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang('header.my_account') <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    @guest
                    <li><a href="{{ route('user-login') }}">@lang('header.login')</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('user-signup') }}" class="sub-li-a">@lang('header.signup')</a></li>
                    @else
                    <li><a href="{{ url('/user-logout') }}" class="sub-li-a">Logout</a></li>
                    @endguest
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ LaravelLocalization::getCurrentLocaleNative() }} <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                      <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </nav>
      </div>
    {{-- </div> --}}

{{-- </div> --}}
