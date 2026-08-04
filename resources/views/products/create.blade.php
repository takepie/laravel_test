
@extends('layouts.app')

@section('title', '商品登録')

@section('content')

<div class="product-create">

    <h1>商品登録</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="create-form-group">
            <label for="name">商品名</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="create-form-group">
            <label for="price">価格</label>
            <input type="number" id="price" name="price">
        </div>

        <div class="create-form-group">
            <label for="description">商品説明</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="create-form-group">
            <label for="stock">在庫数</label>
            <input type="number" id="stock" name="stock">
        </div>

        <div class="create-image-group">
        <label for="image">商品画像</label>
        <input type="file" id="image" name="image">
        </div>

        <div class="create-buttons">
            <a href="{{ route('products.index') }}" class="create-back-btn">
                戻る
            </a>

            <button type="submit" class="create-submit-btn">
                登録
            </button>
        </div>

    </form>

</div>

@endsection