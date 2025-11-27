@extends('layouts.app')

@section('title', 'Каталог игр')

@push('style')
<link rel="stylesheet" href="{{ asset('style/catalog.css') }}">
@endpush

@section('content')
<section class="catalog-section">
    <div class="category-filter">
        <ul>
            <li>
                <a href="{{ route('catalog', ['category' => 'all']) }}"
                   class="{{ request('category') == 'all' || !request('category') ? 'active' : '' }}">
                   Все игры
                </a>
            </li>
            @foreach($categories as $cat)
                <li>
                    <a href="{{ route('catalog', ['category' => $cat->id]) }}"
                       class="{{ request('category') == $cat->id ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
<div class="catalog-grid">
@forelse($games as $game)
    <div class="game-card {{ $game->discount_price ? 'discounted' : '' }}">
        <a href="{{ route('catalog.show', $game) }}" class="game-link">
            <div class="game-image">
                <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}">

                @if($game->discount_price)
                    <span class="discount-badge">СКИДКА</span>
                @endif

                <div class="overlay">
                    @auth
                        <form action="{{ route('cart.add', $game) }}" method="POST" onClick="event.stopPropagation()">
                            @csrf
                            <button type="submit" class="btn-buy">КУПИТЬ</button>
                        </form>
                    @else
                        <a href="{{ route('login.form') }}" class="btn-buy" onClick="event.stopPropagation()">Авторизуйтесь</a>
                    @endauth
                </div>

                @if($game->discount_price)
                    <div class="price-tag">
                        <span class="price">{{ $game->discount_price }}₽</span>
                        <span class="old-price">{{ $game->price }}₽</span>
                    </div>
                @else
                    <div class="price-tag">
                        <span class="price">{{ $game->price }}₽</span>
                    </div>
                @endif
            </div>
            <p class="game-title">{{ $game->title }}</p>
        </a>
    </div>
@empty
    <p class="text-empty">Игры не найдены</p>
@endforelse
</div>
</section>
@endsection
