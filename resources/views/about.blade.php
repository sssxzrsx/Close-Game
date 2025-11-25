@extends('layouts.app')

@section('title', 'О нас')

@push('style')
<link rel="stylesheet" href="{{ asset('style/about.css') }}">
@endpush

@section('content')
<section class="about-section">
    <div class="about-container">
        <h1 class="about-title">О НАШЕМ ПРОЕКТЕ</h1>
        <p class="about-subtitle">
            Close Game Store — цифровая площадка для любителей игр, где можно приобрести лицензионные ключи по честным ценам.
            Мы создаём удобный и безопасный сервис, соединяющий игроков и надёжных издателей.
        </p>

        <div class="about-blocks">
            <div class="about-card">
                <i class="fa-solid fa-gamepad about-icon"></i>
                <h2>Наши цели</h2>
                <p>Мы стремимся сделать покупки игр максимально простыми и доступными,
                   чтобы каждый игрок мог получить удовольствие от любимых тайтлов без лишних затрат.</p>
            </div>

            <div class="about-card">
                <i class="fa fa-shield about-icon"></i>
                <h2>Надёжность и безопасность</h2>
                <p>Все ключи поступают исключительно от официальных дистрибьюторов.
                   Мы гарантируем подлинность и активацию каждого товара.</p>
            </div>

            <div class="about-card">
                <i class="fa-solid fa-handshake about-icon"></i>
                <h2>Поддержка пользователей</h2>
                <p>Наша команда поддержки работает 24/7, чтобы помочь вам по любому вопросу:
                   от покупки до установки игр.</p>
            </div>
        </div>
    </div>
</section>
@endsection
