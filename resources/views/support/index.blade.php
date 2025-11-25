@extends('layouts.app')

@section('title', 'Поддержка')

@push('style')
<link rel="stylesheet" href="{{ asset('style/support.css') }}">
@endpush

@section('content')
<section class="support-section">
    <div class="support-container">
        <h1 class="support-title">Мои обращения</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('support.send') }}" method="POST" class="support-form">
            @csrf
            <textarea name="message" placeholder="Опишите вашу проблему..." required></textarea>
            <button type="submit" class="btn-send">Отправить</button>
        </form>

        @if($tickets->count())
            <div class="support-history">
                @foreach($tickets as $ticket)
                    <div class="ticket-item">
                        <div class="ticket-header">
                            <span class="ticket-date">{{ $ticket->created_at->format('d.m.Y H:i') }}</span>
                                @php
                                    $statusText = match ($ticket->status) {
                                        'open' => 'Открыто',
                                        'answered' => 'Закрыто',
                                        default => ucfirst($ticket->status),
                                    };
                                @endphp

                                <span class="ticket-status {{ $ticket->status }}">
                                    {{ $statusText }}
                                </span>
                        </div>
                        <p class="ticket-message">{{ $ticket->message }}</p>
                        @if($ticket->answer)
                            <div class="ticket-answer-user">
                                <div class="answer-meta">
                                    <span class="answer-label">Ответ поддержки</span>
                                    <span class="answer-date">{{ $ticket->updated_at->format('d.m.Y H:i') }}</span>
                                </div>
                                <p class="answer-text">{{ $ticket->answer }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-empty">Вы ещё не обращались в поддержку.</p>
        @endif
    </div>
</section>
@endsection
