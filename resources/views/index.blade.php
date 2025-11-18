@extends('layouts.app')

@section('content')

<section class="popular-section">
    <h2 class="section-title">САМЫЕ ПОПУЛЯРНЫЕ</h2>

    <div class="slider">
        <div class="slides">
            <div class="slide active">
                <img src="{{ asset('images/battlefield6.png') }}" alt="BATTLEFIELD 6">
                <a href="#" class="btn-more">Подробнее</a>
            </div>

            <div class="slide">
                <img src="{{ asset('images/helldivers2.png') }}" alt="HELLDIVERS 2">
                <a href="#" class="btn-more">Подробнее</a>
            </div>

            <div class="slide">
                <img src="{{ asset('images/forza5.png') }}" alt="Forza Horizen 5">
                <a href="#" class="btn-more">Подробнее</a>
            </div>
        </div>

        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
    </div>
</section>

<section class="advantages-section">
    <h2 class="section-title">НАШИ ПРЕМУЩЕСТВА</h2>

    <div class="advantages-grid">
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Постоянные скидки и акции</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Мгноваенная оплата удобная для вас</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Большой ассортимет товара на любой вкус и цвет</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Работающая поддержка 24/7 для решения ваших  проблем и ответов на вопросы</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Быстрая оформление заказа и получения товара на свой аккаунт</p>
        </div>
        <div class="advantage-card">
            <img src="{{ asset('images/Vector.png') }}">
            <p>Низкие цены на товар по сравнению с конкурентами</p>
        </div>
    </div>
</section>

@endsection
