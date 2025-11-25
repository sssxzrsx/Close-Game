<nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo">
            </a>
        </div>

        <ul class="navbar-links">
            <li><a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'active' : '' }}">КАТАЛОГ</a></li>
            <li><a href="#" class="{{ request()->is('about') ? 'active' : '' }}">О НАС</a></li>
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">ГЛАВНАЯ</a></li>
            <li><a href="{{ route('support') }}" class="{{ request()->is('support') ? 'active' : '' }}">ПОДДЕРЖКА</a></li>

            @auth
                @if(Auth::user()->is_admin)
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa fa-cog"></i> РЕДАКТИРОВАНИЕ
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        <div class="navbar-actions">
            @guest
                <a href="{{ route('login.form') }}" class="btn-auth">ВХОД | РЕГИСТРАЦИЯ</a>
            @else
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="btn-logout">Выйти</button>
                    </form>
                </div>
            @endguest
            <div class="cart-wrapper">
                <a href="{{ route('cart.index') }}" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                </a>

            @auth
                @php
                    $cartItemsCount = \App\Models\Cart::where('user_id', Auth::id())
                            ->withCount('items')
                            ->first()->items_count ?? 0;
                @endphp
                @if($cartItemsCount > 0)
                    <span class="cart-count">{{ $cartItemsCount }}</span>
                @endif
            @endauth
</div>
        </div>
    </div>
</nav>
