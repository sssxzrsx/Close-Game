<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
    <div class="navbar-container">
        <div class="navbar-logo">
            <a href="#"><img src="{{ asset('images/logo.svg') }}" alt="Logo"></a>
        </div>

        <ul class="navbar-links">
            <li><a href="#">КАТАЛОГ</a></li>
            <li><a href="#">О НАС</a></li>
            <li><a href="#">ГЛАВНАЯ</a></li>
            <li><a href="#">ПОДДЕРЖКА</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="#" class="btn-auth">ВХОД | РЕГИСТРАЦИЯ</a>
            <a href="#" class="cart-icon">
                <i class="fa fa-shopping-cart"></i>
            </a>
        </div>
    </div>
</nav>
</body>
</html>
