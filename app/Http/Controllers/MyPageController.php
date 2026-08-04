<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
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
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'name_kanji' => 'nullable|string|max:255',
            'name_kana' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->name_kanji = $request->name_kanji;
        $user->name_kana = $request->name_kana;

        $user->save();

        return redirect()->route('mypage');
    }
}