<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    /**
     * お気に入り登録
     */
    public static function addLike($userId, $productId)
    {
        return self::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
    }

    /**
     * お気に入り解除
     */
    public static function removeLike($userId, $productId)
    {
        return self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();
    }

    /**
     * お気に入り済みか確認
     */
    public static function isLiked($userId, $productId)
    {
        return self::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();
    }
}