<?php

namespace App\Http\Controllers;
use App\Http\Requests\ItemImageRequest;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemEditRequest;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Item;
use App\Category;
use App\Like;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
     //トップ
    public function index () {
        $items = Item::where('user_id', '<>' , \Auth::user() -> id) -> latest() -> paginate(5);
        return view('items.index', [
          'title' => 'トップページ',
          'items' => $items
        ]);
    }

    //新規出品
    public function create () {
        return view('items.create', [
          'title' => '商品を出品',
          'categories' => Category::all(),
        ]);
    }
    
    // 商品追加処理
    public function store(ItemRequest $request, FileUploadService $service)
    {
        //画像投稿処理
        $path = $service->saveImage($request->file('image'));
 
        Item::create([
          'user_id' => \Auth::user()->id,
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price,
          'image' => $path,
          'category_id' => $request ->category_id,
        ]);
        \Session::flash('success', '商品を追加しました');
        return redirect()->route('users.exhibitions', \Auth::user());
    }
    
    //商品情報編集画面呼び出し
    public function edit ($id)
     {
        $item = Item::find($id);
        return view('items.edit', [
          'title' => '商品情報の編集',
          'item' => $item,
          'categories' => Category::all(),
        ]);
      }
    //商品情報編集更新処理
    public function update($id,ItemEditRequest $request) 
    {
        $item = Item::find($id);
        $item->update(
        $request->only(['name',  'description', 'price', 'category_id'])
        );
        session()->flash('success', '商品情報の修正が完了しました');
        return redirect()->route('items.show', $item);
      }
    
    //商品画像変更呼び出し
    public function edit_image($id) 
    {
        $item = Item::find($id);
        return view('items.edit_image', [
          'title' => '商品画像の変更',
          'item' => $item,
        ]);
      }
      
    public function update_image($id, ItemImageRequest $request, FileUploadService $service){
 
      $path = $service->saveImage($request->file('image'));
 
      $item = Item::find($id);
      if($item->image !== ''){
        \Storage::disk('public')->delete($item->image);
      }
      $item->update([
        'image' => $path, // ファイル名を保存
      ]);
 
      \Session::flash('success', '投稿を追加しました');
      return redirect()->route('items.show', $item);
    }
    
    //削除
    public function destroy($id) {
      $item = Item::find($id);
 
      // 画像の削除
      if($item->image !== ''){
        \Storage::disk('public')->delete($item->image);
      }
      $item->delete();
      session()->flash('success', '投稿を削除しました');
      return redirect()->route('users.exhibitions', \Auth::user());
    }
    
    //商品詳細
    public function show ($id) {
       $item = Item::find($id);
        return view('items.show', [
          'title' => '商品詳細',
          'item' => $item,
          ]);
    }
    
    //購入確認
    public function confirm ($id) {
       $item = Item::find($id);
        return view('items.confirm', [
          'title' => '',
          'item' => $item,
          ]);
    }
    
    public function purchase(OrderRequest $request) {
      $order = Order::create([
          'user_id' => \Auth::user()->id,
          'item_id' => $request->item_id,
           ]);
           return redirect()->route('items.finish',$request->item_id);
    }
    
    //購入確定
    public function finish ($id) {
       $item = Item::find($id);
        return view('items.finish', [
          'title' => 'ご購入ありがとうございました。',
          'item' => $item,
          ]);
    }
    
    //お気に入り
    public function toggleLike($id){
          $user = \Auth::user();
          $item = Item::find($id);
 
          if($item->isLikedBy($user)){
              // お気に入りの取り消し
              $item->likes->where('user_id', $user->id)->first()->delete();
              \Session::flash('success', 'お気に入りを削除しました。');
          } else {
              // お気に入りを設定
              Like::create([
                  'user_id' => $user->id,
                  'item_id' => $item->id,
              ]);
              \Session::flash('success', 'お気に入り登録しました。');
          }
          return redirect('/');
      }
}
