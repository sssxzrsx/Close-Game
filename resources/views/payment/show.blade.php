@extends('layouts.app')

@section('title', 'Оплата')

@push('style')
<link rel="stylesheet" href="{{ asset('style/payment.css') }}">
@endpush

@section('content')
<section class="payment-section">
    <div class="payment-container">
        <h1 class="payment-title">ОПЛАТА ЗАКАЗА</h1>
        <p class="payment-subtitle">Выберите удобный способ оплаты:</p>

        <form action="{{ route('payment.process') }}" method="POST" class="payment-form">
            @csrf
            <div class="payment-options">
                <label class="payment-option">
                    <input type="radio" name="method" value="Банковская карта" required>
                    <i class="fa-solid fa-credit-card"></i>
                    <span>Банковская карта</span>
                </label>

                <label class="payment-option">
                    <input type="radio" name="method" value="PayPal">
                    <i class="fa-brands fa-btc"></i>
                    <span>Криптовалюта</span>
                </label>

                <label class="payment-option">
                    <input type="radio" name="method" value="Qiwi">
                    <i class="fa-solid fa-credit-card"></i>
                    <span>СБП</span>
                </label>
            </div>

            <button type="submit" class="btn-pay-submit">Перейти к оплате</button>
        </form>

        <a href="{{ route('cart.index') }}" class="btn-back">← Вернуться в корзину</a>
    </div>
</section>
@endsection
