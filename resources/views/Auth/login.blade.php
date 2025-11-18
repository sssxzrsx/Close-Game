@extends('layouts.app')

@section('title', 'Авторизация')

@push('style')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<section class="login-section">
    <div class="login-box">
        <h2 class="login-title">Вход</h2>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Логин" required autofocus>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>

            <label class="checkbox-label">
                <input type="checkbox" name="remember">
                <span>Запомнить меня</span>
            </label>

            <button type="submit" class="btn-login">Войти</button>

            <p class="text-small">
                Нет аккаунта?
                <a href="{{ route('register.form') }}">Зарегистрироваться</a>
            </p>
        </form>
    </div>
</section>
@endsection
