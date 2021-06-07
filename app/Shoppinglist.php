<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoppinglist extends Model
{
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿を購入済しているユーザ。（ Userモデルとの関係を定義）
     */
    public function bought_users()
    {
        return $this->belongsToMany(User::class, 'boughts', 'shoppinglist_id', 'user_id')->withTimestamps();
    }
    
    /**
     * この投稿を保留しているユーザ。（ Userモデルとの関係を定義）
     */
    public function stay_users()
    {
        return $this->belongsToMany(User::class, 'stays', 'shoppinglist_id', 'user_id')->withTimestamps();
    }
}
