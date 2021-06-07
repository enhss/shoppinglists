<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoughtsController extends Controller
{
    /**
     * 投稿を購入済にするアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿を購入済にする
        \Auth::user()->bought($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿の購入済を外すアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿の購入済を外す
        \Auth::user()->notbought($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}