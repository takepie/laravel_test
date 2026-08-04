@extends('layouts.app')

@section('content')

<div class="mypage-container">

    <h1>マイページ</h1>

    {{-- ログインユーザー情報 --}}
    <a href="{{ route('mypage.edit') }}" class="btn btn-primary">
    アカウント編集</a>

    <div class="user-info">
        <div>
            <p>ユーザ名：{{ $user->name }}</p>
            <p>Eメール：{{ $user->email }}</p>
        </div>

        <div>
            <p>名前：{{ $user->name_kanji ?? '' }}</p>
            <p>カナ：{{ $user->name_kana ?? '' }}</p>
        </div>
    </div>


    {{-- 出品商品 --}}
    <div class="mypage-section">

        <h2>＜出品商品＞</h2>

            <a href="{{ route('products.create') }}" class="btn btn-primary new-product-btn">新規登録
            </a>

        <table class="mypage-table">
            <thead>
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(￥)</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('products.seller_detail', ['id' => $product->id]) }}" class="btn-detail">詳細</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    {{-- 購入した商品 --}}
    <div class="mypage-section">

        <h2>＜購入した商品＞</h2>

        <table class="mypage-table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(￥)</th>
                    <th>個数</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->product_name }}</td>
                        <td>{{ $sale->product->description }}</td>
                        <td>{{ $sale->product->price }}</td>
                        <td>{{ $sale->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection