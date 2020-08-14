<!-- Navbar -->
<nav class="navbar panel top">
    <div class="sections desktop">

        <div class="left">
            <a href="{{ route('index') }}" class="logo">
                {{-- <svg style="width:82px;height:24px">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                </svg> --}}
                {{ __('ShangDa') }}
            </a>
        </div>

        <div class="center">
            <ul class="menu uppercase">
                <li><a href="{{ route('front.about') }}">{{ __('About') }}</a></li>
                <li><a href="{{ route('front.products.index') }}">{{ __('Products') }}</a></li>
                <li><a href="#">{{ __('News') }}</a></li>
                {{-- <li><a href="#">{{ __('Location') }}</a></li> --}}
                <li><a href="{{ route('front.contact_us') }}">{{ __('Contact') }}</a></li>
                @auth
                    <li><a href="{{ route('backend') }}">{{ __('Backend') }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

        <div class="right">
            <ul class="menu trim">
                <li>
                    <a href="http://facebook.com/designmodo" target="_blank">
                        <svg>
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#facebook"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="http://twitter.com/designmodo" target="_blank">
                        <svg>
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#twitter"></use>
                        </svg>
                    </a>
                </li>
                <li class="cropRight">
                    <a href="http://instagram.com/designmodo" class="trimRight" target="_blank">
                        <svg>
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#instagram"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <div class="sections compact hidden">
        <div class="left">
            <a href="https://designmodo.com/?u=3165" title="Slides Framework">
                <svg style="width:82px;height:24px">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#logo"></use>
                </svg>
            </a>
        </div>
        <div class="right">
            <span class="button actionButton sidebarTrigger" data-sidebar-id="1">
                <svg>
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu"></use>
                </svg>
            </span>
        </div>
    </div>
</nav>
