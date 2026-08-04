
@extends('layouts.app')

@section('title', '購入画面')

@section('content')

<div class="purchase">

    <h1>購入画面</h1>

    <div class="purchase-info">

        <p>商品名：{{ $product->product_name }}</p>

        <p>説明：{{ $product->description }}</p>

        <div class="purchase-image">
            @if ($product->img_path)
                <img src="{{ asset('storage/' . $product->img_path) }}"
                     alt="{{ $product->product_name }}">
            @endif
        </div>

        {{-- エラー表示 --}}
        @if ($errors->any())
            <div class="purchase-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif


        <form
            id="purchase-form"
            action="{{ route('products.buy', ['id' => $product->id]) }}"
            method="POST"
        >

            @csrf

            {{-- 購入個数 --}}
            <input
                type="number"
                id="quantity"
                name="quantity"
                value="{{ old('quantity', 1) }}"
                min="1"
                max="{{ $product->stock }}"
                class="quantity-input"
                required
            >

            <p>金額：￥{{ $product->price }}</p>

            <p>残り：{{ $product->stock }}</p>


            <div class="purchase-buttons">

                {{-- ここでは送信しない --}}
                <button
                    type="button"
                    id="open-purchase-modal"
                    class="purchase-btn"
                >
                    購入する
                </button>

                <a
                    href="{{ route('products.detail', ['id' => $product->id]) }}"
                    class="back-btn"
                >
                    戻る
                </a>

            </div>


            {{-- 購入確認モーダル --}}
            <div
                id="purchase-modal"
                class="purchase-modal"
            >

                <div class="purchase-modal-content">

                    <h2>購入確認</h2>

                    <p>
                        「{{ $product->product_name }}」を
                        <span id="confirm-quantity">1</span>
                        個購入しますか？
                    </p>


                    <div class="purchase-modal-buttons">

                        <button
                            type="button"
                            id="close-purchase-modal"
                            class="modal-cancel-btn"
                        >
                            キャンセル
                        </button>


                        {{-- ここで初めてフォーム送信 --}}
                        <button
                            type="submit"
                            class="modal-buy-btn"
                        >
                            購入確定
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('purchase-modal');
    const openButton = document.getElementById('open-purchase-modal');
    const closeButton = document.getElementById('close-purchase-modal');
    const quantity = document.getElementById('quantity');
    const confirmQuantity = document.getElementById('confirm-quantity');

    // 「購入する」を押した時
    openButton.addEventListener('click', function () {

        // 個数の入力チェック
        if (!quantity.checkValidity()) {
            quantity.reportValidity();
            return;
        }

        // 入力した個数を確認画面に表示
        confirmQuantity.textContent = quantity.value;

        // モーダル表示
        modal.classList.add('show');
    });


    // キャンセル
    closeButton.addEventListener('click', function () {
        modal.classList.remove('show');
    });


    // モーダルの外側を押した場合も閉じる
    modal.addEventListener('click', function (event) {

        if (event.target === modal) {
            modal.classList.remove('show');
        }

    });

});
</script>

@endsection