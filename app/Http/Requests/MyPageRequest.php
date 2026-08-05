<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'name_kanji' => [
                'nullable',
                'string',
                'max:255',
            ],

            'name_kana' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'ユーザ名を入力してください。',
            'name.max' => 'ユーザ名は255文字以内で入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',

            'name_kanji.max' => '名前は255文字以内で入力してください。',

            'name_kana.max' => 'カナは255文字以内で入力してください。',
        ];
    }
}