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
            <li><a href="{{ route('index') }}">{{ __('ShangDa') }}</a></li>
            <li><a href="{{ route('front.about') }}">{{ __('About') }}</a></li>
            <li><a href="{{ route('front.products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('front.announcements.index') }}">{{ __('News') }}</a></li>
            <li><a href="{{ route('front.contact') }}">{{ __('Contact') }}</a></li>
            @auth('web')
                {{-- 管理者登入 --}}
                <li><a href="{{ route('backend') }}">{{ __('Backend') }}</a></li>
            @endauth
            @auth('consumer')
                {{-- 客戶登入 --}}
                <li><a href="{{ route('front.consumers.cart', ['id' => Auth::guard('consumer')->id()]) }}">{{ __('Cart') }}</a></li>
                <li><a href="{{ route('consumer.showSaleOrders', ['consumer_id' => Auth::guard('consumer')->id()]) }}">{{ __('Consumer Sale Order') }}</a></li>
            @endauth
        </ul>
        <ul class="subMenu small opacity-8">
            @auth('web')
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
            @else
                @guest('web')
                    <li><a href="{{ route('consumers.login') }}">{{ __('Login') }}</a></li>
                    <li><a href="{{ route('consumers.register') }}">{{ __('Register') }}</a></li>
                @endguest
            @endauth
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
