@extends('layouts.app')

@section('title', $game->title)

@push('style')
<link rel="stylesheet" href="{{ asset('style/game.css') }}">
@endpush

@section('content')
<section class="game-section">
    <div class="game-banner" style="background-image: url('{{ asset('storage/'.$game->image) }}')">
        <div class="banner-overlay"></div>
        <div class="banner-content">
            <h1>{{ $game->title }}</h1>

            @if($game->discount_price)
                <div class="banner-price">
                    <span class="price-discount">{{ $game->discount_price }}₽</span>
                    <span class="price-old">{{ $game->price }}₽</span>
                </div>
            @else
                <div class="banner-price">
                    <span class="price-normal">{{ $game->price }}₽</span>
                </div>
            @endif

            <p class="banner-category">
                Категория: <span>{{ $game->category->name ?? 'Без категории' }}</span>
            </p>

            @auth
                <form action="{{ route('cart.add', $game) }}" method="POST" class="banner-form">
                    @csrf
                    <button type="submit" class="btn-buy">Купить</button>
                </form>
            @else
                <a href="{{ route('login.form') }}" class="btn-buy">Авторизуйтесь, чтобы купить</a>
            @endauth
        </div>
    </div>

    <div class="game-description-container">
        <h2>Об игре</h2>
        <p>{{ $game->description ?? 'Описание пока отсутствует.' }}</p>
    </div>

    @if($related->count())
        <div class="related-section">
            <h2>Похожие игры</h2>
            <div class="related-grid">
                @foreach($related as $rel)
                    <a href="{{ route('catalog.show', $rel) }}" class="related-card">
                        <div class="related-thumb">
                            <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->title }}">
                        </div>
                        <div class="related-info">
                            <h3>{{ $rel->title }}</h3>
                            <p>{{ $rel->category->name ?? 'Без категории' }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
