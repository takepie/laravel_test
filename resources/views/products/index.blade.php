
@extends('layouts.app')

@section('title', '商品一覧')

@section('content')

<div class="container">

    <h1>商品一覧</h1>

    <form id="search-form"
          action="{{ route('products.index') }}"
          method="GET"
          class="search-form">

        <input
            type="text"
            id="keyword"
            name="keyword"
            placeholder="商品名を入力"
            value="{{ request('keyword') }}"
        >

        <input
            type="number"
            id="min_price"
            name="min_price"
            placeholder="最低価格"
            value="{{ request('min_price') }}"
        >

        <span>～</span>

        <input
            type="number"
            id="max_price"
            name="max_price"
            placeholder="最高価格"
            value="{{ request('max_price') }}"
        >

        <button type="submit" class="btn btn-primary">
            検索
        </button>

    </form>


    <table class="table">

        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(￥)</th>
                <th></th>
            </tr>
        </thead>

        <tbody id="product-list">

            @foreach ($products as $product)

                <tr>
                    <td>{{ $product->id }}</td>

                    <td>{{ $product->product_name }}</td>

                    <td>{{ $product->description }}</td>

                    <td>
                        @if ($product->img_path)
                            <img
                                src="{{ asset('storage/' . $product->img_path) }}"
                                alt="{{ $product->product_name }}"
                            >
                        @endif
                    </td>

                    <td>{{ $product->price }}</td>

                    <td>
                        <a
                            href="{{ route('products.detail', ['id' => $product->id]) }}"
                            class="btn btn-success"
                        >
                            詳細
                        </a>
                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchForm = document.getElementById('search-form');
    const productList = document.getElementById('product-list');

    searchForm.addEventListener('submit', async function (event) {

        // 通常のページ遷移を止める
        event.preventDefault();

        const formData = new FormData(searchForm);
        const params = new URLSearchParams(formData);

        try {

            const response = await fetch(
                "{{ route('products.index') }}?" + params.toString(),
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }
            );

            if (!response.ok) {
                throw new Error('検索に失敗しました。');
            }

            const products = await response.json();

            productList.innerHTML = '';

            if (products.length === 0) {

                productList.innerHTML = `
                    <tr>
                        <td colspan="6">
                            商品が見つかりませんでした。
                        </td>
                    </tr>
                `;

                return;
            }

            products.forEach(function (product) {

                let image = '';

                if (product.img_path) {
                    image = `
                        <img
                            src="/storage/${product.img_path}"
                            alt="${escapeHtml(product.product_name)}"
                        >
                    `;
                }

                const row = `
                    <tr>
                        <td>${product.id}</td>

                        <td>${escapeHtml(product.product_name)}</td>

                        <td>${escapeHtml(product.description)}</td>

                        <td>${image}</td>

                        <td>${product.price}</td>

                        <td>
                            <a
                                href="/product/detail/${product.id}"
                                class="btn btn-success"
                            >
                                詳細
                            </a>
                        </td>
                    </tr>
                `;

                productList.insertAdjacentHTML('beforeend', row);
            });

        } catch (error) {

            console.error(error);

            alert('検索中にエラーが発生しました。');
        }

    });


    function escapeHtml(value) {

        if (value === null || value === undefined) {
            return '';
        }

        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

});
</script>

@endsection