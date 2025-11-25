@extends('layouts.app')

@section('title', 'Админ-панель')

@push('style')
<link rel="stylesheet" href="{{ asset('style/admin.css') }}">
@endpush

@section('content')
<section class="admin-section">

    <h1>ПАНЕЛЬ АДМИНИСТРАТОРА</h1>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="admin-card">
        <h2>Категории</h2>

        <form class="admin-form" method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <input type="text" name="name" placeholder="Введите название категории" required>
            <button type="submit" class="btn-admin">Добавить категорию</button>
        </form>

        <ul class="admin-list">
            @foreach ($categories as $category)
                <li>
                    <span>{{ $category->name }}</span>
                    <form method="POST" action="{{ route('admin.categories.delete', $category) }}">
                        @csrf @method('DELETE')
                        <button class="btn-delete" type="submit">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="admin-divider"></div>

    <div class="admin-card">
        <h2>Игры</h2>

        <form class="admin-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.games.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Название игры" required>
            <input type="number" name="price" placeholder="Цена" required step="0.01">
            <input type="number" name="discount_price" placeholder="Скидочная цена" step="0.01">
            <select name="category_id">
                <option value="">Без категории</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            <input type="file" name="image">
            <textarea name="description" placeholder="Описание"></textarea>
            <button type="submit" class="btn-admin">Добавить игру</button>
        </form>

        <ul class="admin-list">
            @foreach($games as $game)
                <li class="admin-game-item">
                    <div style="display:flex; align-items:center;">
                        @if($game->image)
                            <img src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->title }}">
                        @endif
                        <div>
                            <span>{{ $game->title }}</span><br>
                            <small style="color:#8DA8CF;">{{ $game->category->name ?? 'Без категории' }}</small>
                        </div>
                    </div>
                    <form action="{{ route('admin.games.delete', $game) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="admin-divider"></div>

    <div class="admin-card">
        <h2>Обращения пользователей</h2>

        @forelse($tickets as $ticket)
            <div class="ticket-block">
                <div class="ticket-header">
                    <div class="ticket-meta">
                        <span class="ticket-user">{{ $ticket->user->name }}</span>
                        <span class="ticket-email">{{ $ticket->user->email }}</span>
                    </div>
                    <span class="ticket-date">{{ $ticket->created_at->format('d.m.Y H:i') }}</span>
                </div>

                <p class="ticket-message">{{ $ticket->message }}</p>

                @if($ticket->answer)
                    <div class="ticket-answer">
                        <div class="answer-label">Ответ администратора</div>
                        <p>{{ $ticket->answer }}</p>
                    </div>

                    <form action="{{ route('admin.tickets.delete', $ticket) }}" method="POST" style="margin-top: 0.6rem;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Удалить обращение</button>
                    </form>
                @else
                    <form action="{{ route('admin.tickets.answer', $ticket) }}" method="POST" class="admin-form ticket-form">
                        @csrf
                        <textarea name="answer" placeholder="Введите ответ..." required></textarea>
                        <button type="submit" class="btn-admin">Отправить ответ</button>
                    </form>
                @endif

                <div class="ticket-status-bar">
                    <span class="ticket-status-label {{ $ticket->status }}">
                        {{ strtoupper($ticket->status) }}
                    </span>
                </div>
            </div>
        @empty
            <p style="text-align:center; color:#888;">Пока нет обращений пользователей.</p>
        @endforelse
    </div>

</section>
@endsection
