<!-- Sidebar -->
<nav class="sidebar" data-sidebar-id="1">
    <div class="close">
        <svg>
            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close"></use>
        </svg>
    </div>
    <div class="content">
        <a href="#" class="logo">
            <svg width="37" height="30">
                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo-icon"></use>
            </svg>
        </a>
        <ul class="mainMenu margin-top-3">
            <li><a href="#">{{ __('About') }}</a></li>
            <li><a href="#">{{ __('Products') }}</a></li>
            <li><a href="#">{{ __('News') }}</a></li>
            <li><a href="#">{{ __('Location') }}</a></li>
            <li><a href="#">{{ __('Contact') }}</a></li>
        </ul>
        <ul class="subMenu small opacity-8">
            @guest
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
                <li><a href="{{ route('backend') }}">{{ __('Backend') }}</a></li>
                <li><a href="#">{{ __('Profile') }}</a></li>
                <li>
                    <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            @endguest
            <li><a href="#">{{ __('Terms & Conditions') }}</a></li>
            <li><a href="#">{{ __('Privacy Policy') }}</a></li>
        </ul>
        <ul class="social opacity-8">
            <li>
                <a href="#">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#facebook">
                        </use>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#twitter">
                        </use>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg>
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#instagram">
                        </use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</nav>