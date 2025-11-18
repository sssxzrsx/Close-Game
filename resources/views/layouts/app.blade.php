<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>

    <link rel="stylesheet" href="{{ asset('style/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('style/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">
    <link rel="stylesheet" href="{{ asset('style/register.css') }}">
    <link rel="stylesheet" href="{{ asset('style/login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    @stack('style')
</head>
<body>
    @include('layouts.navbar')

    <main>
        @yield('content')
    </main>

    @if (!in_array(request()->route()->getName(), ['login.form', 'register.form']))
        @include('layouts.footer')
    @endif
    <script src="{{ asset('js/slider.js') }}" defer></script>
</body>
</html>
