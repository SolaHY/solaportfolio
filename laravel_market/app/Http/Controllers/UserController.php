<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Item;
use App\Services\FileUploadService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;

class UserController extends Controller

{
// プロフィール
      public function show($id)
      {
        $user = User::find($id);
        $itemCount =$user->items->count();
        $items = Item::find($id);
        $orders = \Auth::user()->order()->get();
        return view('users.show', [
          'title' => 'プロフィール',
          'user' => $user,
          'itemCount' => $itemCount,
          'items' => $items,
          'orders' => $orders,
        ]);
      }
      // プロフィール編集
      public function edit()
      {
        $user = \Auth::user();
        return view('users.edit', [
          'title' => 'プロフィール編集',
          'user' => $user,
        ]);
      }
      /// プロフィール画像変更処理
      public function editImage()
      {
        $user = \Auth::user();
        return view('users.edit_image', [
          'title' => 'プロフィール画像編集',
          'user' => $user,
        ]);
      }
      
      public function update(UserRequest $request) {
        $user = \Auth::user();
        $user->update(
          $request->only(['name',  'profile'])
        );
        session()->flash('success', 'プロフィールの修正が完了しました');
        return redirect()->route('users.show', $user);
      }
      
      public function updateImage(UserImageRequest $request, FileUploadService $service) {
        $user = \Auth::user();
        $path = $service->saveImage($request->file('image'));
        if($user->image !== ''){
          \Storage::disk('public')->delete('photos/' . $user->image);
        }
        $user->update([
          'image' => $path, // ファイル名を保存
        ]);
   
        \Session::flash('success', 'プロフィール画像を更新しました');
        return redirect()->route('users.show', $user);
      }
      
      //出品商品一覧
      public function exhibitions($id)
      {
        $user = User::find($id);
        // ログインユーザーに紐づく投稿一覧を取得
        $items = $user->items()->latest()->paginate(3);
        return view('users.exhibitions', [
          'title' => '出品商品一覧画面',
          'user' => $user,
          'items' => $items,
        ]);
      }

}
