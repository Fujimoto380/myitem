<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Storage;
class ItemController extends Controller
{
    public function add()
    {
        return view('admin.item.create');
    }
    public function create(Request $request)
    {
        $this->validate($request, Item::$rules);
        $item = new Item;
        $form = $request->all();
        $code = $form['code'];
        $r = substr($code,1,2);
        $g = substr($code,3,2);
        $b = substr($code,5,2);
        //10進数に変換
        $r_dec = hexdec($r);
        $g_dec = hexdec($g);
        $b_dec = hexdec($b);
        $ary = Array($r_dec,$g_dec,$b_dec);
        //3値の最大値
        $max = max($ary);
        //3値の最小値
        $min = min($ary);
        //Hを求める
        if($max == $min){
            $h_val = 0;
        } else {
            switch($max){
                case $r_dec:
                $h_val = (60 * (($g_dec - $b_dec)/($max - $min)));
                break;
            case $g_dec:
                $h_val = (60 * (($b_dec - $r_dec)/($max - $min))) + 120;
                break;
            case $b_dec:
                $h_val = (60 * (($r_dec - $g_dec)/($max - $min))) + 240;
                break;
            }
            while($h_val < 0){
                $h_val += 360;
            }
        }
        //Sを求める
        $s_val = ($max === 0)? 0:($max - $min) / $max;
        $s_val *= 100;
        //Vを求める
        $v_val = ($max / 255) * 100;
        if ($v_val <= 20){
            $item->colortype = 'wn';
        } else if($s_val >= 60 && $v_val >= 60) {
            $item->colortype = 'sp';
        } else if ($s_val <= 59 && $v_val <= 59) {
            $item->colortype = 'au';
        } else if ($s_val <= 59 && $v_val >= 60) {
            $item->colortype = 'sm';
        } else {
            $item->colortype = 'wn';
        }
        if (isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            $item->image_path = Storage::disk('s3')->url($path);
        } else {
            $item->image_path = 'noimage.jpg';
        }
        unset($form['_token']);
        unset($form['image']);
        $item->fill($form);
        $item->userid = Auth::id();
        $item->save();
        return redirect('admin/item');
    }
    public function edit(Request $request)
    {
        // Item Modelからデータを取得する
        $item = Item::find($request->id);
        if (empty($item)) {
            abort(404);    
        }
        return view('admin.item.edit', ['item_form' => $item]);
    }
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Item::$rules);
        // Item Modelからデータを取得する
        $item = Item::find($request->id);
        // 送信されてきたフォームデータを格納する
        $item_form = $request->all();

        $code = $item_form['code'];
        $r = substr($code,1,2);
        $g = substr($code,3,2);
        $b = substr($code,5,2);
        //10進数に変換
        $r_dec = hexdec($r);
        $g_dec = hexdec($g);
        $b_dec = hexdec($b);
        $ary = Array($r_dec,$g_dec,$b_dec);
        //3値の最大値
        $max = max($ary);
        //3値の最小値
        $min = min($ary);
        //Hを求める
        if($max == $min){
            $h_val = 0;
        } else {
            switch($max){
                case $r_dec:
                $h_val = (60 * (($g_dec - $b_dec)/($max - $min)));
                break;
            case $g_dec:
                $h_val = (60 * (($b_dec - $r_dec)/($max - $min))) + 120;
                break;
            case $b_dec:
                $h_val = (60 * (($r_dec - $g_dec)/($max - $min))) + 240;
                break;
            }
            while($h_val < 0){
                $h_val += 360;
            }
        }
        //Sを求める
        $s_val = ($max === 0)? 0:($max - $min) / $max;
        $s_val *= 100;
        //Vを求める
        $v_val = ($max / 255) * 100;
        if ($v_val <= 20){
            $item->colortype = 'wn';
        } else if($s_val >= 60 && $v_val >= 60) {
            $item->colortype = 'sp';
        } else if ($s_val <= 59 && $v_val <= 59) {
            $item->colortype = 'au';
        } else if ($s_val <= 59 && $v_val >= 60) {
            $item->colortype = 'sm';
        } else {
            $item->colortype = 'wn';
        }

        // 画像の変更
        if (isset($item_form['image'])) {
        $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
        $item->image_path = Storage::disk('s3')->url($path);
        unset($item_form['image']);
        } elseif (isset($request->remove)) {
        $item->image_path = 'noimage.jpg';
        unset($item_form['remove']);
        }
        unset($item_form['_token']);

        // 該当するデータを上書きして保存する
        $item->fill($item_form)->save();
        
        return redirect('admin/item');
    }
    public function delete(Request $request)
    {
        // 該当するItem Modelを取得
        $item = Item::find($request->id);
        // 削除する
        $item->delete();
        return redirect('admin/item/');
    }
    public function index(Request $request)
    {
        $cond_itemname = $request->cond_itemname;
        $recommend = $request->recommend;
        $new = $request->new;
        if ($cond_itemname != '') {
            // 検索されたら検索結果を取得する
            $posts = Item::where('itemname', $cond_itemname)->where('userid', Auth::id())->get();
            $posts = $posts->sortByDesc('updated_at');
        } else if ($recommend != '') {
            // オススメ順
            $posts = Item::where('userid', Auth::id())->where('colortype', Auth::user()->pc)->get();
            $posts = $posts->sortByDesc('updated_at');
            $add = Item::where('userid', Auth::id())->where('colortype', '<>', Auth::user()->pc)->get();
            $add = $add->sortByDesc('updated_at');
            $posts = $posts->merge($add);
        } else if ($new != '') {
            $posts = Item::where('userid', Auth::id())->get();
            $posts = $posts->sortByDesc('updated_at');
        } else {
            // それ以外はすべてを取得する
            $posts = Item::where('userid', Auth::id())->get();
            $posts = $posts->sortByDesc('updated_at');
        }
    return view('admin.item.index', ['posts' => $posts, 'cond_itemname' => $cond_itemname]);
  }
}