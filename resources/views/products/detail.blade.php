
@extends('layouts.app')

@section('title', '商品詳細')

@section('content')

<div class="product-detail">

    <h1>商品詳細</h1>

    <div class="product-detail-info">

        <p>商品名：{{ $product->product_name }}</p>

        <p>説明：{{ $product->description }}</p>

        <div class="product-detail-image">
            <span>画像：</span>

            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}"
                     alt="{{ $product->product_name }}">
            @endif
        </div>

        <p>金額：￥{{ $product->price }}</p>

        <div class="product-heart">

            @auth

                @if ($isLiked)

            {{-- お気に入り解除 --}}
                    <form action="{{ route('products.unlike', ['id' => $product->id]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')

                        <button type="submit" class="heart-btn liked">♥
                        </button>
                    </form>

                @else

            {{-- お気に入り登録 --}}
                    <form action="{{ route('products.like', ['id' => $product->id]) }}"
                  method="POST">
                        @csrf

                        <button type="submit" class="heart-btn">♡</button>
                    </form>

                @endif

            @endauth

        </div>

        <div class="product-detail-buttons">

            <a href="{{ route('products.purchase', ['id' => $product->id]) }}"
               class="cart-btn">
                カートに追加する
            </a>

            <a href="{{ route('products.index') }}"
               class="back-btn">
                戻る
            </a>

        </div>

    </div>

</div>

@endsection