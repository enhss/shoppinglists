<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $shoppinglists = $user->shoppinglists()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'shoppinglists' => $shoppinglists,
        ]);
    }
    
     /**
     * ユーザの購入済一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function boughts($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの購入済一覧を取得
        $boughts = $user->boughts()->paginate(10);

        // 購入済一覧ビューでそれらを表示
        return view('users.boughts', [
            'user' => $user,
            'shoppinglists' => $boughts,
        ]);
    }
    
     /**
     * ユーザの保留一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function stays($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの保留一覧を取得
        $stays = $user->stays()->paginate(10);

        // 保留一覧ビューでそれらを表示
        return view('users.stays', [
            'user' => $user,
            'shoppinglists' => $stays,
        ]);
    }
}
