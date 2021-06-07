<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * このユーザが所有する投稿。（ Shoppinglistモデルとの関係を定義）
     */
    public function shoppinglists()
    {
        return $this->hasMany(Shoppinglist::class);
    }
    
    /**
     * このユーザに関係するモデルの件数をロードする。
     */
    public function loadRelationshipCounts()
    {
        $this->loadCount(['shoppinglists', 'boughts', 'stays']);
    }
    
    /**
     * このユーザとフォロー中ユーザの投稿に絞り込む。
     */
    public function feed_shoppinglists()
    {
        // 購入済＆保留されていない投稿を取得
        return Shoppinglist::doesntHave('bought_users')->doesntHave('stay_users');
    }
    
    /**
     * このユーザが購入済の投稿。（ Userモデルとの関係を定義）
     */
    public function boughts()
    {
        return $this->belongsToMany(Shoppinglist::class, 'boughts', 'user_id', 'shoppinglist_id')->withTimestamps();
    }
    
    /**
     * $shoppinglistIdで指定された投稿を購入済にする。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function bought($shoppinglistId)
    {
        // すでに購入済しているかの確認
        $exist = $this->is_bought($shoppinglistId);
        
        if ($exist) {
            // すでに購入済にしていれば何もしない
            return false;
        } else {
            // 未購入であれば購入済にする
            $this->boughts()->attach($shoppinglistId);
            return true;
        }
    }

    /**
     * $shoppinglistIdで指定された投稿の購入済を外す。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function notbought($shoppinglistId)
    {
        // すでに購入済にしているかの確認
        $exist = $this->is_bought($shoppinglistId);

        if ($exist) {
            // すでに購入済にしていれば購入済を外す
            $this->boughts()->detach($shoppinglistId);
            return true;
        } else {
            // 未購入であれば何もしない
            return false;
        }
    }

    /**
     * 指定された $shoppinglistIdの投稿をこのユーザが購入済であるか調べる。購入済ならtrueを返す。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function is_bought($shoppinglistId)
    {
        // 購入済投稿の中に $shoppinglistIdのものが存在するか
        return $this->boughts()->where('shoppinglist_id', $shoppinglistId)->exists();
    }
    
    /**
     * このユーザが保留の投稿。（ Userモデルとの関係を定義）
     */
    public function stays()
    {
        return $this->belongsToMany(Shoppinglist::class, 'stays', 'user_id', 'shoppinglist_id')->withTimestamps();
    }
    
    /**
     * $shoppinglistIdで指定された投稿を保留にする。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function stay($shoppinglistId)
    {
        // すでに保留しているかの確認
        $exist = $this->is_stay($shoppinglistId);
        
        if ($exist) {
            // すでに保留にしていれば何もしない
            return false;
        } else {
            // 未保留であれば保留する
            $this->stays()->attach($shoppinglistId);
            return true;
        }
    }

    /**
     * $shoppinglistIdで指定された投稿の保留を外す。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function notstay($shoppinglistId)
    {
        // すでに保留にしているかの確認
        $exist = $this->is_stay($shoppinglistId);

        if ($exist) {
            // すでに保留にしていれば保留を外す
            $this->stays()->detach($shoppinglistId);
            return true;
        } else {
            // 未保留であれば何もしない
            return false;
        }
    }

    /**
     * 指定された $shoppinglistIdの投稿をこのユーザが保留済であるか調べる。保留済ならtrueを返す。
     *
     * @param  int  $shoppinglistId
     * @return bool
     */
    public function is_stay($shoppinglistId)
    {
        // 保留投稿の中に $shoppinglistIdのものが存在するか
        return $this->stays()->where('shoppinglist_id', $shoppinglistId)->exists();
    }
}
