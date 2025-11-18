<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Навигация</title>
</head>
<body>
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
        <li><a href="#" class="">ПОДДЕРЖКА</a></li>
    </ul>

        <div class="navbar-actions">
            @guest
                <a href="{{ route('register.form') }}" class="btn-auth">ВХОД | РЕГИСТРАЦИЯ</a>
            @else
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="btn-logout">Выйти</button>
                    </form>
                </div>
            @endguest

            <a href="#" class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>

    </div>
</nav>
</body>
</html>
