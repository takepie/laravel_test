
@extends('layouts.app')

@section('title', '出品商品編集')

@section('content')

<div class="product-edit">

    <h1>出品商品編集</h1>
        @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <form action="{{ route('products.update', ['id' => $product->id]) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <div class="edit-form-group">
            <label for="name">商品名</label>
            <input type="text"id="name"
            name="name" value="{{ $product->product_name }}">
        </div>

        <div class="edit-form-group">
            <label for="price">価格</label>
            <input type="number" id="price"
            name="price"
            value="{{ $product->price }}">
        </div>

        <div class="edit-form-group">
            <label for="description">商品説明</label>
            <textarea id="description"
            name="description">{{ $product->description }}</textarea>
        </div>

        <div class="edit-form-group">
            <label for="stock">在庫数</label>
            <input type="number"
            id="stock"
            name="stock"
            value="{{ $product->stock }}">
        </div>

        <div class="edit-image-group">

            <label>商品画像</label>

            @if ($product->img_path)
            <img src="{{ asset('storage/' . $product->img_path) }}"
            alt="{{ $product->product_name }}">
            @endif

            <input type="file" id="image" name="image">

        </div>

        <div class="edit-buttons">

            <a href="{{ route('products.seller_detail', ['id' => $product->id]) }}"
            class="edit-back-btn">戻る
            </a>

            <button type="submit" class="edit-submit-btn">
                更新
            </button>

        </div>

    </form>

</div>

@endsection