@extends('layouts.app')

@section('title', 'Оплата')

@push('style')
<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
@endpush

@section('content')
<section class="payment-section">
    <div class="payment-container">
        <h1 class="payment-title">ОПЛАТА ЗАКАЗА</h1>
        <p class="payment-subtitle">Сумма к оплате: <strong>{{ number_format($cart->items->sum(function($item) { 
            $price = $item->game->discount_price ?? $item->game->price; 
            return $price * ($item->quantity ?? 1); 
        }), 2) }} ₽</strong></p>

        @if($errors->any())
            <div class="payment-errors">
                @foreach($errors->all() as $error)
                    <div class="error-message">⚠️ {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('payment.process') }}" method="POST" class="payment-form">
            @csrf
            
            <div class="payment-options">
                <div class="payment-options-title">Способ оплаты <span class="required-star">*</span></div>
                
                <label class="payment-option">
                    <input type="radio" name="method" value="card" required>
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Банковская карта</span>
                </label>

                <label class="payment-option">
                    <input type="radio" name="method" value="crypto">
                    <i class="fa-brands fa-btc"></i>
                    <span>Криптовалюта</span>
                </label>

                <label class="payment-option">
                    <input type="radio" name="method" value="sbp">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>СБП</span>
                </label>
            </div>

            <div class="payment-field">
                <label class="payment-label">
                    <i class="fa-brands fa-steam"></i>
                    Логин Steam аккаунта
                    <span class="required-star">*</span>
                </label>
                <input type="text" name="steam_login" class="payment-input" placeholder="Введите ваш логин в Steam" value="{{ old('steam_login') }}" required>
                <small class="payment-hint">🎮 Бот добавит вас в друзья для передачи товара</small>
            </div>

            <button type="submit" class="btn-pay-submit">Перейти к оплате</button>
        </form>

        <a href="{{ route('cart.index') }}" class="btn-back">← Вернуться в корзину</a>
    </div>
</section>
@endsection