<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyPageRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * マイページ
     */
    public function index()
    {
        $user = Auth::user();

        // 出品商品を商品番号の昇順で取得
        $products = Product::getProductsByUser($user->id);

        // 購入商品を購入日の昇順で取得
        $sales = Sale::getSalesByUser($user->id);

        return view('mypage.index', compact(
            'user',
            'products',
            'sales'
        ));
    }

    /**
     * アカウント情報編集画面
     */
    public function edit()
    {
        $user = Auth::user();

        return view('mypage.edit', compact('user'));
    }

    /**
     * アカウント情報更新処理
     */
    public function update(MyPageRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->name_kanji = $request->name_kanji;
        $user->name_kana = $request->name_kana;

        $user->save();

        return redirect()->route('mypage');
    }
}