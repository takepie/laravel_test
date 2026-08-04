
@extends('layouts.app')

@section('title', '新規ユーザ登録')

@section('content')

<div class="container">
    <div class="card">

        <div class="card-header">新規ユーザ登録</div>

        <div class="card-body">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- ユーザ名 --}}
                <div class="row mb-3">
                    <label for="name" class="col-md-4">
                        Name（ユーザ名）
                    </label>

                    <div class="col-md-6">
                        <input
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                        >

                        @error('name')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- 名前（漢字） --}}
                <div class="row mb-3">
                    <label for="name_kanji" class="col-md-4">
                        名前（漢字）
                    </label>

                    <div class="col-md-6">
                        <input
                            id="name_kanji"
                            type="text"
                            class="form-control @error('name_kanji') is-invalid @enderror"
                            name="name_kanji"
                            value="{{ old('name_kanji') }}"
                            required
                        >

                        @error('name_kanji')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- 名前（カナ） --}}
                <div class="row mb-3">
                    <label for="name_kana" class="col-md-4">
                        名前（カナ）
                    </label>

                    <div class="col-md-6">
                        <input
                            id="name_kana"
                            type="text"
                            class="form-control @error('name_kana') is-invalid @enderror"
                            name="name_kana"
                            value="{{ old('name_kana') }}"
                            required
                        >

                        @error('name_kana')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- メールアドレス --}}
                <div class="row mb-3">
                    <label for="email" class="col-md-4">
                        メールアドレス
                    </label>

                    <div class="col-md-6">
                        <input
                            id="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                        >

                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- パスワード --}}
                <div class="row mb-3">
                    <label for="password" class="col-md-4">
                        パスワード
                    </label>

                    <div class="col-md-6">
                        <input
                            id="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            required
                        >

                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                {{-- パスワード確認 --}}
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4">
                        パスワード（確認用）
                    </label>

                    <div class="col-md-6">
                        <input
                            id="password-confirm"
                            type="password"
                            class="form-control"
                            name="password_confirmation"
                            required
                        >
                    </div>
                </div>


                {{-- 登録ボタン --}}
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">

                        <button type="submit" class="btn btn-primary">
                            登録
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection