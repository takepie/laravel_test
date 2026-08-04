
@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('content')

<div class="contact-form">

    <h1>お問い合わせフォーム</h1>

    {{-- 送信完了メッセージ --}}
    @if (session('success'))
        <div class="contact-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 入力エラー --}}
    @if ($errors->any())
        <div class="contact-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST">

        @csrf

        <div class="contact-form-group">
            <label for="name">名前</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div class="contact-form-group">
            <label for="email">メールアドレス</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="contact-form-group">
            <label for="message">お問い合わせ内容</label>

            <textarea
                id="message"
                name="message"
                required
            >{{ old('message') }}</textarea>
        </div>

        <div class="contact-buttons">

            <button type="submit" class="contact-submit-btn">
                送信
            </button>

            <a href="{{ route('products.index') }}"
               class="contact-back-btn">
                戻る
            </a>

        </div>

    </form>

</div>

@endsection