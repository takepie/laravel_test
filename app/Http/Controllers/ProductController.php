<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
        /**
     * 商品一覧・商品検索
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // 商品名：部分一致検索
        if ($request->filled('keyword')) {
            $query->where(
                'product_name',
                'like',
                '%' . $request->keyword . '%'
            );
        }

        // 最低価格
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // 最高価格
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query
            ->orderBy('id', 'asc')
            ->get();

        // 非同期検索の場合はJSONを返す
        if ($request->ajax()) {
            return response()->json($products);
        }

        // 通常アクセスの場合は商品一覧画面を表示
        return view('products.index', compact('products'));
    }

        public function detail($id)
    {
        $product = Product::findOrFail($id);

        $isLiked = false;

        if (Auth::check()) {
            $isLiked = Like::isLiked(Auth::id(), $product->id);
        }

        return view('products.detail', compact('product', 'isLiked'));
    }

    /**
     * 購入画面
     */
    public function purchase($id)
    {
        $product = Product::findOrFail($id);

        return view('products.purchase', compact('product'));
    }


    /**
     * 商品購入処理
     */
    /**
 * 商品購入処理
 */
    public function buy(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);

        // 在庫がない場合
        if ($product->stock <= 0) {
            return back()->withErrors([
                'quantity' => 'この商品は売り切れです。',
            ]);
        }

        // 在庫数を超えて購入できないようにする
        if ($request->quantity > $product->stock) {
            return back()->withErrors([
                'quantity' => '在庫数を超えて購入することはできません。',
            ]);
        }

        // 購入履歴を保存
        Sale::createSale(
            Auth::id(),
            $product->id,
            $request->quantity
        );

        // 購入した個数分だけ在庫を減らす
        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('mypage');
    }

    /**
     * 商品登録画面
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 商品登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ]);

        $img_path = null;

        if ($request->hasFile('image')) {
            $img_path = $request->file('image')
                ->store('products', 'public');
        }

        Product::createProduct([
            'user_id' => Auth::id(),
            'company_id' => 1,
            'product_name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $img_path,
        ]);

        return redirect()->route('mypage');
    }

    /**
     * 出品商品詳細画面
     */
    public function sellerDetail($id)
    {
        $product = Product::findOrFail($id);

        return view('products.seller_detail', compact('product'));
    }

    /**
     * 出品商品編集画面
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * 商品更新処理
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->product_name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;

        if ($request->hasFile('image')) {
            $product->img_path = $request->file('image')
                ->store('products', 'public');
        }

        $product->save();

        return redirect()
            ->route('products.seller_detail', ['id' => $product->id]);
    }

    /**
     * 商品削除処理
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('mypage');
    }
        /**
     * お気に入り登録
     */
    public function like($id)
    {
        $product = Product::findOrFail($id);

        Like::addLike(Auth::id(), $product->id);

        return redirect()
            ->route('products.detail', ['id' => $product->id]);
    }

    /**
     * お気に入り解除
     */
    public function unlike($id)
    {
        $product = Product::findOrFail($id);

        Like::removeLike(Auth::id(), $product->id);

        return redirect()
            ->route('products.detail', ['id' => $product->id]);
    }
}