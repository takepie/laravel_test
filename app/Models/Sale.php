<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * 購入した商品を購入日の昇順で取得
     */
    public static function getSalesByUser($user_id)
    {
        return self::with('product')
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * 商品を購入
     */
    public static function createSale($user_id, $product_id, $quantity)
    {
        return self::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
        ]);
    }

    /**
     * 購入した商品情報
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}