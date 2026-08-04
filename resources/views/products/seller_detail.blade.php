
@extends('layouts.app')

@section('title', '出品商品詳細')

@section('content')

<div class="seller-detail">

    <h1>出品商品詳細</h1>

    <div class="seller-detail-info">

        <p>商品名：{{ $product->product_name }}</p>

        <p>説明：{{ $product->description }}</p>

        <div class="seller-detail-image">
            <span>画像：</span>

            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}"
                     alt="{{ $product->product_name }}">
            @endif
        </div>

        <p>金額：￥{{ $product->price }}</p>

        <div class="seller-detail-buttons">

            <a href="{{ route('products.edit', ['id' => $product->id]) }}"
               class="seller-edit-btn">
                編集
            </a>

            <form action="{{ route('products.destroy', ['id' => $product->id]) }}"
                  method="POST"
                  class="seller-delete-form">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="seller-delete-btn"
                        onclick="return confirm('この商品を削除しますか？')">
                    削除する
                </button>
            </form>

            <a href="{{ route('mypage') }}"
               class="seller-back-btn">
                戻る
            </a>

        </div>

    </div>

</div>

@endsection