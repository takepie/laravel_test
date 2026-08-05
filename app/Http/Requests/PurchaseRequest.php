<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'quantity.required' => '購入個数を入力してください。',
            'quantity.integer' => '購入個数は整数で入力してください。',
            'quantity.min' => '購入個数は1個以上にしてください。',
        ];
    }
}