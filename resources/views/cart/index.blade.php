@extends('layouts.app')

@section('title', 'Корзина')

@push('style')
<link rel="stylesheet" href="{{ asset('style/cart.css') }}">
@endpush

@section('content')
<section class="cart-section">
    <h1 class="cart-title">КОРЗИНА</h1>

    @if($items->count())
        <table class="cart-table">
            <thead>
                <tr>
                    <th class="cart-col-game">СПИСОК ТОВАРОВ</th>
                    <th>КОЛИЧЕСТВО</th>
                    <th>ЦЕНА</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="cart-item-info">
                            <img src="{{ asset('storage/' . $item->game->image) }}" alt="{{ $item->game->title }}">
                            <span>{{ $item->game->title }}</span>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ ($item->game->discount_price ?? $item->game->price) * $item->quantity }}₽</td>
                        <td>
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-remove">×</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-footer">
            <div class="cart-total">Итого: <strong>{{ $total }}₽</strong></div>
            <div class="cart-actions">
                <button class="btn-pay">ОПЛАТИТЬ</button>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-clear">ОЧИСТИТЬ КОРЗИНУ</button>
                </form>
            </div>
        </div>
    @else
        <p class="cart-empty">Ваша корзина пуста</p>
    @endif
</section>
@endsection
