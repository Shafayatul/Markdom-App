    {{-- <div class="body-wrap"> --}}
    <div class="container">
      <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
          <ul>
            @if((Session::has('is_driver')) && (Session::get('is_driver') == 1))
              <li><a href="{{ url('orders/create') }}">Make Order</a></li>
              <li><a href="{{ url('driver-orders-list') }}">Order List</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Customer Order <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                      <a rel="alternate"  href="{{ url('/customer-order/restaurant') }}">
                          Restuarent
                      </a>
                    </li>
                    <li>
                      <a rel="alternate"  href="{{ url('/customer-order/worker') }}">
                          Worker
                      </a>
                    </li>
                    <li>
                      <a rel="alternate"  href="{{ url('/customer-order/store') }}">
                          Store
                      </a>
                    </li>
                    <li>
                      <a rel="alternate"  href="{{ url('/customer-relocation-order') }}">
                          Relocation
                      </a>
                    </li>
                </ul>
              </li>
              <li><a href="{{ route('Restaurant') }}">Restorant</a></li>
              <li><a href="{{ route('Store') }}" class="main-li-a">Store</a></li>
              <li><a href="{{ route('Worker') }}" class="main-li-a">Workers</a></li>
              <li><a href="{{ route('Relocation') }}" class="main-li-a">Relocation</a></li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">@lang('header.my_account') <b class="caret"></b></a>
              <ul class="dropdown-menu">
                @if (Session::has('access_token'))
                <li><a href="{{ url('/user-logout') }}" class="sub-li-a">Logout</a></li>
                @endif
                @if (!Session::has('access_token'))
                <li><a href="{{ route('user-login') }}">@lang('header.login')</a></li>
                <li class="divider"></li>
                <li><a href="{{ route('user-signup') }}" class="sub-li-a">@lang('header.signup')</a></li>
                @endif
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
                  @if($loop->last)
                    
                  @else
                    <li class="divider"></li>
                  @endif
                  
                @endforeach
              </ul>
            </li>

          </ul>
        </div>
      </div>
        {{-- <nav class="navbar navbar-inverse" role="navigation">
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
                    @if (Session::has('access_token'))
                    <li><a href="{{ url('/user-logout') }}" class="sub-li-a">Logout</a></li>
                    @endif
                    @if (!Session::has('access_token'))
                    <li><a href="{{ route('user-login') }}">@lang('header.login')</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('user-signup') }}" class="sub-li-a">@lang('header.signup')</a></li>
                    @endif
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
        </nav> --}}
      <div class="logo">
        <a href="{{ url('/') }}"><span>Mkh</span>dom</a>
      </div>
      <span onclick="openNav()" id="menu-collapse">&#9776;</span>
    </div>
    {{-- </div> --}}

{{-- </div> --}}

