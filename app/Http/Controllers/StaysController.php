<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaysController extends Controller
{
    /**
     * 投稿を保留にするアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿を保留する
        \Auth::user()->stay($id);
        // 前のURLへリダイレクトさせる
        return back();
    }

    /**
     * 投稿の保留を外すアクション。
     *
     * @param  $id  投稿のid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idの投稿の保留を外す
        \Auth::user()->notstay($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
