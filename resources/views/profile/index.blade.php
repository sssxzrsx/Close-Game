@extends('layouts.app')

@section('title', 'Профиль')

@push('style')
    <link rel="stylesheet" href="{{ asset('style/profile.css') }}">
@endpush

@section('content')
<section class="profile-section">
    <div class="profile-container">
        <h1 class="profile-title">ПРОФИЛЬ</h1>

        <div class="profile-card">
            <div class="profile-row">
                <span class="profile-label">Логин:</span>
                <strong class="profile-value">{{ $user->name ?? $user->login ?? $user->email }}</strong>
            </div>
            <div class="profile-row">
                <span class="profile-label">Email:</span>
                <span class="profile-value">{{ $user->email ?? '—' }}</span>
            </div>
            <div class="profile-row">
                <span class="profile-label">Зарегистрирован:</span>
                <span class="profile-value">{{ $user->created_at ? $user->created_at->format('d.m.Y') : '—' }}</span>
            </div>
        </div>

        <div class="panel">
            <h2 class="profile-subtitle">📦 История покупок</h2>

            @if($orders->count())
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Статус</th>
                            <th>Оплата</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @php
                                $firstItem = $order->items->first();
                                $game = $firstItem ? $firstItem->game : null;
                                $itemsCount = $order->items->count();
                            @endphp
                            <tr>
                                <td>
                                    <div class="game-info">
                                        <div class="game-image-wrapper">
                                            @if($game && $game->image)
                                                <img src="{{ asset('storage/' . $game->image) }}" 
                                                     alt="{{ $game->title }}"
                                                     class="game-image"
                                                     onerror="this.onerror=null; this.src=''; this.parentElement.innerHTML='<div class=\"game-image-placeholder\">🎮</div>
                                            @else
                                                <div class="game-image-placeholder">🎮</div>
                                            @endif
                                        </div>
                                        <div class="game-name">
                                            <strong>{{ $game ? $game->title : 'Товар' }}</strong>
                                            @if($itemsCount > 1)
                                                <span class="more-items">+ ещё {{ $itemsCount - 1 }} товар(а)</span>
                                            @endif
                                            @if(isset($order->steam_login) && $order->steam_login)
                                                <div class="steam-info">
                                                    <small>🎮 Steam: {{ $order->steam_login }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>

                                <td class="amount">{{ number_format($order->total_amount, 2) }} ₽</td>

                                <td>
                                    @php
                                        $statusMap = [
                                            'created' => ['🟡 Новый', 'status-processing'],
                                            'pending' => ['⏳ Ожидает оплаты', 'status-processing'],
                                            'processing' => ['🔄 В обработке', 'status-processing'],
                                            'paid' => ['✅ Оплачен', 'status-paid'],
                                            'completed' => ['✔️ Выполнен', 'status-completed'],
                                            'cancelled' => ['❌ Отменен', 'status-cancelled'],
                                            'refunded' => ['↩️ Возврат', 'status-cancelled'],
                                        ];
                                        $currentStatus = $order->status ?? 'created';
                                        $status = $statusMap[$currentStatus] ?? [$currentStatus, 'status-processing'];
                                    @endphp
                                    <span class="status {{ $status[1] }}">{{ $status[0] }}</span>
                                </td>

                                <td>
                                    @php
                                        $paymentMap = [
                                            'card' => 'Карта',
                                            'sbp' => 'Сбербанк',
                                            'crypto' => 'Криптовалюта',
                                        ];
                                        $paymentMethod = $order->payment_method ?? '—';
                                        $paymentDisplay = $paymentMap[$paymentMethod] ?? $paymentMethod;
                                    @endphp
                                    <span class="payment">{{ $paymentDisplay }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="profile-pagination">
                    {{ $orders->links() }}
                </div>
            @else
                <p class="profile-empty">🛒 Покупок пока нет</p>
            @endif
        </div>
    </div>
</section>
@endsection