<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * リクエストを許可
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

            'message' => [
                'required',
                'string',
                'max:2000',
            ],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages(): array
    {
        return [
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は255文字以内で入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',

            'message.required' => 'お問い合わせ内容を入力してください。',
            'message.max' => 'お問い合わせ内容は2000文字以内で入力してください。',
        ];
    }
}