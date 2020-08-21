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
                <li><a href="{{ route('front.announcements.index') }}">{{ __('News') }}</a></li>
                {{-- <li><a href="#">{{ __('Location') }}</a></li> --}}
                <li><a href="{{ route('front.contact') }}">{{ __('Contact') }}</a></li>
                @auth('web')
                    {{-- 管理者登入 --}}
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
                @endauth
                @auth('consumer')
                    {{-- 客戶登入 --}}
                    <li><a href="{{ route('front.consumers.cart', ['id' => Auth::guard('consumer')->id()]) }}">{{ __('Cart') }}</a></li>
                    <li>
                        <a href="#" onclick="
                            event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('consumers.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>

        <div class="right">
            <ul class="menu trim">
                @auth('web')
                    <li>
                        <a href="#">
                            嗨，{{ Auth::user()->name . ' (' . Auth::user()->jobTitle->name . ')' }}
                        </a>
                    </li>
                @endauth
                @auth('consumer')
                    <li>
                        <a href="{{ route('front.consumers.profile', ['id' => Auth::guard('consumer')->id()]) }}">
                            嗨，{{ Auth::guard('consumer')->user()->name }}
                        </a>
                    </li>
                @else
                    @guest('web')
                        <li><a href="{{ route('consumers.login') }}">{{ __('Login') }}</a></li>
                    @endguest
                @endauth
                
                {{-- <li>
                    <a href="http://facebook.com/designmodo" target="_blank">
                        <svg>
                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#facebook"></use>
                        </svg>
                    </a>
                </li> --}}
                {{-- <li>
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
                </li> --}}
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
