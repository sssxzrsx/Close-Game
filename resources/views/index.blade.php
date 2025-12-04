@extends('layouts.app')

@section('content')

<section class="popular-section">
    <h2 class="section-title">САМЫЕ ПОПУЛЯРНЫЕ</h2>

    <div class="slider">
        <div class="slides">
            <div class="slide active">
                <img src="{{ asset('images/slide 1.jpg') }}" alt="BATTLEFIELD 6">
                <a href="{{ route('catalog.show', 11) }}" class="btn-more">
                    Подробнее</a>
            </div>
            <div class="slide">
                <img src="{{ asset('images/slide 2.jpg') }}" alt="HELLDIVERS 2">
                <a href="{{ route('catalog.show', 19) }}" class="btn-more">
                    Подробнее</a>
            </div>
            <div class="slide">
                <img src="{{ asset('images/slide 3.jpg') }}" alt="Forza Horizen 5">
                <a href="{{ route('catalog.show', 18) }}" class="btn-more">
                    Подробнее</a>
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
        <i class="fa-solid fa-gift"></i>
            <p>Постоянные скидки и акции</p>
        </div>
        <div class="advantage-card">
            <i class="fa-solid fa-clock"></i>
            <p>Мгноваенная оплата удобная для вас</p>
        </div>
        <div class="advantage-card">
            <i class="fa-solid fa-shopping-basket"></i>
            <p>Большой ассортимет товара на любой вкус и цвет</p>
        </div>
        <div class="advantage-card">
            <i class="fa-solid fa-users"></i>
            <p>Работающая поддержка 24/7 для решения ваших  проблем и ответов на вопросы</p>
        </div>
        <div class="advantage-card">
            <i class="fa-solid fa-rocket"></i>
            <p>Быстрая оформление заказа и получения товара на свой аккаунт</p>
        </div>
        <div class="advantage-card">
            <i class="fa-solid fa-rub"></i>
            <p>Низкие цены на товар по сравнению с конкурентами</p>
        </div>
    </div>
</section>

@endsection
