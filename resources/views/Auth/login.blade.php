@extends('layouts.app')

@section('title', 'Авторизация')

@push('style')
<link rel="stylesheet" href="{{ asset('style/auth.css') }}">
@endpush

@section('content')
<section class="auth-section">
    <div class="auth-box">
        <h2 class="auth-title">Вход</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf
            <input type="text" name="name" placeholder="Логин"
                   value="{{ old('name') }}" required autofocus>
            <input type="password" name="password" placeholder="Пароль" required>

            <label class="checkbox-label">
                <input type="checkbox" name="remember">
                Запомнить меня
            </label>

            <button type="submit" class="btn-auth">Войти</button>

            <p class="auth-link">Нет аккаунта?
                <a href="{{ route('register.form') }}">Регистрация</a>
            </p>
        </form>
    </div>
</section>
@endsection
