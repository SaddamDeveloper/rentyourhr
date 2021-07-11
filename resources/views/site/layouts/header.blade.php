@if (Route::getCurrentRoute()->getName() == "welcome")
<header class="header-area main-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo-area">
                    <a href="{{ route('welcome') }}"><img src="{{ asset('site/assets/images/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="custom-navbar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="main-menu">
                    <ul>
                        <li class="active"><a href="{{ route('welcome') }}">home</a></li>
                        <li><a href="{{ route('about_us') }}">about us</a></li>
                        <li><a href="{{ route('job.offers') }}">We Offers</a></li>
                        <li><a href="{{ route('contact') }}">contact</a></li>
                        <li class="menu-btn">
                            @if (Auth::check())
                                <li class="menu-btn">
                                    <a href="#" class="login">{{ Auth::user()->name }}</a>
                                    <a href="{{ route('logout') }}" class="template-btn"onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">Logout</a>
                                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST"  style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li class="menu-btn">
                                    <a href="{{ route('joinus') }}" class="login">Join US</a>
                                </li>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
@else
<header class="header-area single-page">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo-area">
                        <a href="{{ route('welcome') }}"><img src="{{ asset('site/assets/images/logo-light.png') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="custom-navbar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="main-menu main-menu-light">
                        <ul>
                            <li class="active"><a href="{{ route('welcome') }}">home</a></li>
                            <li><a href="{{ route('about_us') }}">about us</a></li>
                            <li><a href="{{ route('job.offers') }}">We Offers</a></li>
                            <li><a href="{{ route('contact') }}">contact</a></li>
                            <li class="menu-btn">
                                @if (Auth::check())
                                    <li class="menu-btn">
                                        <a href="#" class="login">{{ Auth::user()->name }}</a>
                                        <a href="{{ route('logout') }}" class="template-btn"onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">Logout</a>
                                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST"  style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li class="menu-btn">
                                        <a href="{{ route('joinus') }}" class="login">Join US</a>
                                    </li>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('page-hero')
</header>
@endif
