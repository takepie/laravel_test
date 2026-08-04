<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * 登録後の遷移先
     */
    protected $redirectTo = '/home';

    /**
     * 新規登録画面は未ログインユーザーのみ
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * バリデーション
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'name_kanji' => [
                'required',
                'string',
                'max:255',
            ],

            'name_kana' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);
    }

    /**
     * ユーザー登録
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'name_kanji' => $data['name_kanji'],
            'name_kana' => $data['name_kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}