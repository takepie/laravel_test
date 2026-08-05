<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * このリクエストを許可
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,gif,webp,svg',
                'max:2048',
            ],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages(): array
    {
        return [
            'name.required' => '商品名を入力してください。',
            'name.max' => '商品名は255文字以内で入力してください。',

            'price.required' => '価格を入力してください。',
            'price.integer' => '価格は整数で入力してください。',
            'price.min' => '価格は0以上で入力してください。',

            'description.required' => '商品説明を入力してください。',

            'stock.required' => '在庫数を入力してください。',
            'stock.integer' => '在庫数は整数で入力してください。',
            'stock.min' => '在庫数は0以上で入力してください。',

            'image.file' => '商品画像にはファイルを指定してください。',
            'image.mimes' => '商品画像はjpg、jpeg、png、gif、webp、svg形式にしてください。',
            'image.max' => '商品画像は2MB以下にしてください。',
        ];
    }
}