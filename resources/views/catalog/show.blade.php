@extends('layouts.app')

@section('title', $game->title)

@push('style')
<link rel="stylesheet" href="{{ asset('style/game.css') }}">
@endpush

@section('content')
<section class="game-page">
    <div class="game-container">
        <div class="game-image">
            <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->title }}">
        </div>

        <div class="game-info">
            <h1 class="game-title">{{ $game->title }}</h1>

            @if($game->discount_price)
                <div class="price-block">
                    <span class="price">{{ $game->discount_price }}₽</span>
                    <span class="old-price">{{ $game->price }}₽</span>
                </div>
            @else
                <div class="price-block">
                    <span class="price">{{ $game->price }}₽</span>
                </div>
            @endif

            <p class="game-category">
                Категория:
                <span>{{ $game->category->name ?? 'Без категории' }}</span>
            </p>

            <p class="game-description">
                {{ $game->description ?? 'Описание пока отсутствует.' }}
            </p>

            @auth
                <form action="{{ route('cart.add', $game) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-buy">Купить</button>
                </form>
            @else
                <a href="{{ route('login.form') }}" class="btn-buy">Авторизуйтесь, чтобы купить</a>
            @endauth
        </div>
    </div>

    @if($related->count())
        <div class="related-games">
            <h2>Похожие игры</h2>
            <div class="related-grid">
                @foreach($related as $rel)
                    <a href="{{ route('catalog.show', $rel) }}" class="related-card">
                        <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->title }}">
                        <p>{{ $rel->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
