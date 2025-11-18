@extends('layouts.app')

@section('title', 'Регистрация')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<section class="register-section">
    <div class="register-box">
        <h2 class="register-title">РЕГИСТРАЦИЯ</h2>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Логин" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Почта" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Повторите пароль" required>
            </div>

            <label class="checkbox-label">
                <input type="checkbox" name="accept_rules" required>
                <span>Я принимаю <a href="#">правила пользования сайтом</a> и
                    <a href="#">политику обработки персональных данных</a></span>
            </label>

            <button type="submit" class="btn-register">Регистрация</button>

            <p class="text-small">
                Уже зарегистрированы?
                <a href="{{ route('login.form') }}">Войти</a>
            </p>
        </form>
    </div>
</section>
@endsection
