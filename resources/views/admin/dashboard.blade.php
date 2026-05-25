@extends('layouts.app')

@section('title', 'Админ-панель')

@push('style')
<link rel="stylesheet" href="{{ asset('style/admin.css') }}">
@endpush

@section('content')
<div class="admin-tabs">
    <button class="tab-link active" data-tab="categories">Категории</button>
    <button class="tab-link" data-tab="games">Игры</button>
    <button class="tab-link" data-tab="tickets">Обращения</button>
    <button class="tab-link" data-tab="orders">Заказы</button>
    <button class="tab-link" data-tab="users">Пользователи</button>
</div>

<section class="admin-section">
    <h1>ПАНЕЛЬ АДМИНИСТРАТОРА</h1>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Вкладка Категории --}}
    <div id="categories" class="tab-content active">
        <div class="admin-card">
            <h2>Категории</h2>
            <form class="admin-form" method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <input type="text" name="name" placeholder="Введите название категории" required>
                <button type="submit" class="btn-admin">Добавить категорию</button>
            </form>
            <ul class="admin-list">
                @foreach($categories as $category)
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
    </div>

    {{-- Вкладка Игры --}}
    <div id="games" class="tab-content">
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
                <div class="file-upload">
                    <label for="image" class="file-upload-label">Выбрать изображение</label>
                    <input type="file" id="image" name="image" accept="image/*" onchange="showFileName(this)">
                    <span class="file-chosen">Файл не выбран</span>
                </div>
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
                        <div class="action-buttons" style="display: flex; gap: 8px; margin-left: auto;">
                            <a href="{{ route('admin.games.edit', $game) }}" class="btn-edit">Редактировать</a>
                            <form action="{{ route('admin.games.delete', $game) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Удалить</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="pagination-wrapper">
                {{ $games->onEachSide(1)->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

    {{-- Вкладка Обращения --}}
    <div id="tickets" class="tab-content">
        <div class="admin-card">
            <h2>Обращения пользователей</h2>
            @forelse($tickets as $ticket)
                <div class="ticket-block">
                    <div class="ticket-header">
                        <div class="ticket-meta">
                            <span class="ticket-user">{{ $ticket->user->name ?? $ticket->user->email }}</span>
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
                        @php
                            $statusText = match ($ticket->status) {
                                'open' => 'Открыто',
                                'answered' => 'Закрыто',
                                default => ucfirst($ticket->status),
                            };
                        @endphp
                        <span class="ticket-status-label {{ $ticket->status }}">
                            {{ $statusText }}
                        </span>
                    </div>
                </div>
            @empty
                <p style="text-align:center; color:#888;">Пока нет обращений пользователей.</p>
            @endforelse
        </div>
    </div>

    {{-- Вкладка Заказы --}}
    <div id="orders" class="tab-content">
        <div class="admin-card">
            <h2>Управление заказами</h2>
            
            @if($orders->count())
                <div class="orders-filter">
                    <select id="statusFilter" class="filter-select">
                        <option value="all">Все статусы</option>
                        <option value="created">🟡 Новые</option>
                        <option value="processing">🔄 В обработке</option>
                        <option value="paid">✅ Оплачен</option>
                        <option value="completed">✔️ Выполнен</option>
                        <option value="cancelled">❌ Отменен</option>
                    </select>
                    <input type="text" id="orderSearch" placeholder="Поиск по Steam логину..." class="filter-input">
                </div>
                
                <div class="orders-table-container">
                    <table class="admin-orders-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Пользователь</th>
                                <th>Steam логин</th>
                                <th>Сумма</th>
                                <th>Способ оплаты</th>
                                <th>Статус</th>
                                <th>Дата</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody id="ordersTableBody">
                            @foreach($orders as $order)
                                <tr data-status="{{ $order->status }}" data-steam="{{ $order->steam_login ?? '' }}">
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? $order->user->email }}</td>
                                    <td>{{ $order->steam_login ?? '—' }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }} ₽</td>
                                    <td>
                                        @php
                                            $paymentIcons = [
                                                'card' => '💳 Карта',
                                                'crypto' => '₿ Криптовалюта',
                                                'sbp' => '🏦 СБП',
                                            ];
                                        @endphp
                                        {{ $paymentIcons[$order->payment_method] ?? $order->payment_method ?? '—' }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="status-update-form">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="status-select" onchange="this.form.submit()">
                                                <option value="created" {{ $order->status == 'created' ? 'selected' : '' }}>🟡 Новый</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 В обработке</option>
                                                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>✅ Оплачен</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✔️ Выполнен</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Отменен</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    <td>
                                        <button type="button" class="btn-view-order" onclick="showOrderDetails({{ $order->id }})">Детали</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>
            @else
                <p class="profile-empty" style="text-align:center; padding:2rem;">Заказов пока нет</p>
            @endif
        </div>
    </div>

    {{-- Вкладка Пользователи --}}
    <div id="users" class="tab-content">
        <div class="admin-card">
            <h2>Управление пользователями</h2>
            
            <div class="users-filter">
                <select id="userStatusFilter" class="filter-select">
                    <option value="all">Все пользователи</option>
                    <option value="active">🟢 Активные</option>
                    <option value="banned">🔒 Заблокированные</option>
                </select>
                <input type="text" id="userSearch" placeholder="Поиск по имени или email..." class="filter-input">
            </div>
            
            <div class="users-table-container">
                <table class="admin-users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя пользователя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Статус</th>
                            <th>Зарегистрирован</th>
                            <th>Заказов</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach($users as $user)
                            <tr data-name="{{ strtolower($user->name ?? '') }}" data-email="{{ strtolower($user->email ?? '') }}" data-banned="{{ $user->is_banned ? '1' : '0' }}">
                                <td>#{{ $user->id }}</td>
                                <td>{{ $user->name ?? '—' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_admin)
                                        <span class="role-badge admin">👑 Администратор</span>
                                    @else
                                        <span class="role-badge user">👤 Пользователь</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_banned)
                                        <span class="status-badge banned">🔒 Заблокирован</span>
                                    @else
                                        <span class="status-badge active">🟢 Активен</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d.m.Y') }}</td>
                                <td>{{ $user->orders_count ?? 0 }}</td>
                                <td>
                                    @if(!$user->is_admin)
                                        @if($user->is_banned)
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-unban" onclick="return confirm('Разблокировать пользователя {{ $user->name ?? $user->email }}?')">
                                                    🔓 Разблокировать
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-ban" onclick="return confirm('Заблокировать пользователя {{ $user->name ?? $user->email }}?')">
                                                    🔒 Заблокировать
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="protected-badge">🛡️ Защищен</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</section>

{{-- Модальное окно деталей заказа --}}
<div id="orderModal" class="order-modal">
    <div class="order-modal-content">
        <div class="order-modal-header">
            <h3>Детали заказа #<span id="modalOrderId"></span></h3>
            <span class="order-modal-close">&times;</span>
        </div>
        <div class="order-modal-body" id="orderModalBody">
            <div style="text-align:center; padding:2rem;">Загрузка...</div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.tab-link').forEach(button => {
    button.addEventListener('click', () => {
        const tab = button.getAttribute('data-tab');

        document.querySelectorAll('.tab-link').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        button.classList.add('active');
        document.getElementById(tab).classList.add('active');
    });
});

function showFileName(input) {
    const fileChosen = document.querySelector('.file-chosen');
    if (fileChosen) {
        fileChosen.textContent = input.files.length > 0 ? input.files[0].name : 'Файл не выбран';
    }
}

const statusFilter = document.getElementById('statusFilter');
const orderSearch = document.getElementById('orderSearch');
const ordersTableBody = document.getElementById('ordersTableBody');

function filterOrders() {
    const status = statusFilter?.value || 'all';
    const search = orderSearch?.value?.toLowerCase() || '';
    
    const rows = ordersTableBody?.querySelectorAll('tr');
    rows?.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const rowSteam = row.getAttribute('data-steam')?.toLowerCase() || '';
        
        let showByStatus = status === 'all' || rowStatus === status;
        let showBySearch = search === '' || rowSteam.includes(search);
        
        row.style.display = (showByStatus && showBySearch) ? '' : 'none';
    });
}

if (statusFilter) {
    statusFilter.addEventListener('change', filterOrders);
    statusFilter.addEventListener('keyup', filterOrders);
}
if (orderSearch) orderSearch.addEventListener('keyup', filterOrders);

const userSearch = document.getElementById('userSearch');
const userStatusFilter = document.getElementById('userStatusFilter');
const usersTableBody = document.getElementById('usersTableBody');

function filterUsers() {
    const search = userSearch?.value?.toLowerCase() || '';
    const status = userStatusFilter?.value || 'all';
    
    const rows = usersTableBody?.querySelectorAll('tr');
    rows?.forEach(row => {
        const name = row.getAttribute('data-name') || '';
        const email = row.getAttribute('data-email') || '';
        const isBanned = row.getAttribute('data-banned') === '1';
        
        let showByStatus = true;
        if (status === 'active') showByStatus = !isBanned;
        if (status === 'banned') showByStatus = isBanned;
        
        let showBySearch = search === '' || name.includes(search) || email.includes(search);
        
        row.style.display = (showByStatus && showBySearch) ? '' : 'none';
    });
}

if (userSearch) userSearch.addEventListener('keyup', filterUsers);
if (userStatusFilter) userStatusFilter.addEventListener('change', filterUsers);

function showOrderDetails(orderId) {
    fetch(`/admin/orders/${orderId}/details`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalOrderId').textContent = orderId;
            
            let itemsHtml = '';
            if (data.items && data.items.length > 0) {
                data.items.forEach(item => {
                    itemsHtml += `
                        <div class="order-detail-item">
                            <span class="item-title">${item.title}</span>
                            <span class="item-price">${item.price} ₽ x ${item.quantity}</span>
                            <span class="item-sum">${item.sum} ₽</span>
                        </div>
                    `;
                });
            } else {
                itemsHtml = '<p style="color:#888;">Нет товаров в заказе</p>';
            }
            
            document.getElementById('orderModalBody').innerHTML = `
                <div class="order-detail-info">
                    <p><strong>Пользователь:</strong> ${data.user_name}</p>
                    <p><strong>Steam логин:</strong> ${data.steam_login || '—'}</p>
                    <p><strong>Способ оплаты:</strong> ${data.payment_method || '—'}</p>
                    <p><strong>Дата создания:</strong> ${data.created_at}</p>
                    <p><strong>Статус:</strong> <span class="status-badge">${data.status_text}</span></p>
                    <p><strong>Сумма заказа:</strong> <span class="order-total">${data.total_amount} ₽</span></p>
                </div>
                <div class="order-detail-items">
                    <h4>Товары в заказе:</h4>
                    ${itemsHtml}
                </div>
            `;
            
            document.getElementById('orderModal').style.display = 'flex';
        })
        .catch(error => {
            console.error('Ошибка:', error);
            document.getElementById('orderModalBody').innerHTML = '<div style="text-align:center; padding:2rem; color:#ff4d4d;">❌ Не удалось загрузить детали заказа</div>';
        });
}

document.querySelector('.order-modal-close')?.addEventListener('click', function() {
    document.getElementById('orderModal').style.display = 'none';
});

window.addEventListener('click', function(event) {
    const modal = document.getElementById('orderModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    filterOrders();
    filterUsers();
});
</script>
@endsection