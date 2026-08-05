
@extends('layouts.app')

@section('title', 'アカウント情報編集')

@section('content')

<div class="account-edit">

    <h1>アカウント情報編集</h1>

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="validation-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mypage.update') }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">ユーザ名</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
            >
        </div>

        <div class="form-group">
            <label for="email">Eメール</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
            >
        </div>

        <div class="form-group">
            <label for="name_kanji">名前</label>
            <input
                type="text"
                id="name_kanji"
                name="name_kanji"
                class="form-control"
                value="{{ old('name_kanji', $user->name_kanji) }}"
            >
        </div>

        <div class="form-group">
            <label for="name_kana">カナ</label>
            <input
                type="text"
                id="name_kana"
                name="name_kana"
                class="form-control"
                value="{{ old('name_kana', $user->name_kana) }}"
            >
        </div>

        <div class="edit-buttons">

            <a href="{{ route('mypage') }}" class="edit-back-btn">
                戻る
            </a>

            <button type="submit" class="edit-submit-btn">
                更新
            </button>

        </div>

    </form>

</div>

@endsection