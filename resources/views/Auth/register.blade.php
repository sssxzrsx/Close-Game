@extends('layouts.app')

@section('title', 'Регистрация')

@push('style')
<link rel="stylesheet" href="{{ asset('style/auth.css') }}">
@endpush

@section('content')
<section class="auth-section">
    <div class="auth-box">
        <h2 class="auth-title">РЕГИСТРАЦИЯ</h2>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf
            <input type="text" name="name" placeholder="Имя" required>
            <input type="email" name="email" placeholder="Почта" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>

            <label class="checkbox-label">
                <input type="checkbox" name="accept_rules" required>
                Я принимаю <a href="#">правила сайта</a> и <a href="#">политику обработки персональных данных</a>
            </label>

            <button type="submit" class="btn-auth">Зарегистрироваться</button>

            <p class="auth-link">Уже есть аккаунт? <a href="{{ route('login.form') }}">Войти</a></p>
        </form>
    </div>
</section>
@endsection
