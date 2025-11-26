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
            Close Game Store — цифровая площадка для настоящих геймеров. Мы делаем покупку игр простой, безопасной и доступной.
            Наша миссия — объединить игроков и создателей контента, предоставляя честные цены и отличный сервис.
        </p>

        <div class="about-features">
            <h2>ПОЧЕМУ ВЫБИРАЮТ НАС</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <i class="fa-solid fa-coins"></i>
                    <h3>Лучшие цены</h3>
                    <p>Благодаря прямым контрактам с дистрибьюторами мы предлагаем скидки до 60 % на игры.</p>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    <h3>Безопасные покупки</h3>
                    <p>Все ключи приобретаются у проверенных издателей и проходят проверку на подлинность.</p>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-users"></i>
                    <h3>Поддержка 24/7</h3>
                    <p>Мы всегда онлайн — отвечаем на вопросы, решаем проблемы и помогаем выбрать нужную игру.</p>
                </div>
                <div class="feature-item">
                    <i class="fa-solid fa-rocket"></i>
                    <h3>Мгновенная доставка</h3>
                    <p>После оплаты вы моментально получаете ключ — без задержек и ожидания писем на почту.</p>
                </div>
            </div>
        </div>

        <div class="about-mission">
            <h2>Миссия проекта</h2>
            <p>
                Мы хотим создать не просто интернет‑магазин, а место, где игрок чувствует заботу и уверенность в покупке.
                Каждый наш шаг направлен на улучшение вашего опыта: мы тестируем каждую функцию, исправляем ошибки и слушаем отзывы.
            </p>
        </div>

        <div class="about-team">
            <h2>НАША КОМАНДА</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-icon"><i class="fa-solid fa-user-gear"></i></div>
                    <h3>Разработчики</h3>
                    <p>Отвечают за стабильность платформы, внедрение новых функций и удобство для пользователей.</p>
                </div>
                <div class="team-member">
                    <div class="member-icon"><i class="fa-solid fa-headset"></i></div>
                    <h3>Служба поддержки</h3>
                    <p>Реагирует на запросы игроков 24/7 — всегда готовы выслушать и помочь.</p>
                </div>
                <div class="team-member">
                    <div class="member-icon"><i class="fa-solid fa-bullhorn"></i></div>
                    <h3>Маркетинг и партнёры</h3>
                    <p>Организуют акции, скидки и договариваются об эксклюзивных релизах для наших клиентов.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
