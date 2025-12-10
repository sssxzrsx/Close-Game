@extends('layouts.app')

@section('title', 'Редактирование')

@push('style')
<link rel="stylesheet" href="{{ asset('style/admin.css') }}">
@endpush

@section('content')
<section class="admin-section">
    <h1>Редактировать игру: {{ $game->title }}</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.games.update', $game) }}" enctype="multipart/form-data" class="admin-form">
        @csrf
        @method('PUT')

        <input type="text" name="title" value="{{ old('title', $game->title) }}" placeholder="Название игры" required>
        <input type="number" name="price" value="{{ old('price', $game->price) }}" step="0.01" placeholder="Цена" required>
        <input type="number" name="discount_price" value="{{ old('discount_price', $game->discount_price) }}" placeholder="Скидочная цена" step="0.01">

        <select name="category_id">
            <option value="">Без категории</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $game->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <textarea name="description" placeholder="Описание">{{ old('description', $game->description) }}</textarea>

        @if($game->image)
            <p>Текущее изображение:</p>
            <img src="{{ asset('storage/'.$game->image) }}" style="max-width: 200px;"><br>
        @endif

        <div class="file-upload">
            <label for="image" class="file-upload-label">Выбрать изображение</label>
            <input type="file" id="image" name="image" accept="image/*" onchange="showFileName(this)">
            <span class="file-chosen">Файл не выбран</span>
        </div>

        <button type="submit" class="btn-admin">Сохранить изменения</button>
    </form>
</section>
@endsection