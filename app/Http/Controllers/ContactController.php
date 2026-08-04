<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * お問い合わせ画面
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * お問い合わせ送信処理
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        return redirect()
            ->route('products.index');
    }
}