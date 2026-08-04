<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    /**
     * ログインユーザーが出品している商品を
     * 商品番号の昇順で取得
     */
    public static function getProductsByUser($user_id)
    {
        return self::where('user_id', $user_id)
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * 商品を登録
     */
    public static function createProduct($data)
    {
        return self::create($data);
    }
}