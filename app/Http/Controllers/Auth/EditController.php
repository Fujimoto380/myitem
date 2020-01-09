<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function edit(Request $request)
    {
        $auth = Auth::user();
        return view('auth.edit',[ 'auth' => $auth ]);
    }
    public function update(Request $request)
    {
        // 対象レコード取得
        $user = Auth::user();
        // リクエストデータ受取
        $form = $request->all();
        // フォームトークン削除
        unset($form['_token']);
        // レコードアップデート
        $user->name = $form['name'];
        $user->pc = $form['pc'];
        $user->save();
        return redirect('/admin/item');
    }
}
