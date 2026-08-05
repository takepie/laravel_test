<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;

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
    public function send(ContactRequest $request)
    {
        return redirect()
            ->route('products.index');
    }
}