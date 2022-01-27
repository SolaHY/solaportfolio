<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


//トップページ
Route::get('/', 'ItemController@index' )->name('top'); 

//プロフィール詳細
Route::get('/users/{user}', 'UserController@show')->name('users.show');

//プロフィール編集
Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
Route::patch('/profile', 'UserController@update')->name('users.update');

//プロフィール画像編集
Route::get('profile/edit_image', 'UserController@editImage')->name('profile.edit_image');
Route::patch('/profile/edit_image', 'UserController@updateImage')->name('users.update_image');

//出品商品一覧
Route::get('users/{user}/exhibitions', 'UserController@exhibitions')->name('users.exhibitions');

Route::resource('items', 'ItemController');

//商品画像変更
Route::get('items/{item}/edit_image', 'ItemController@edit_image')->name('items.edit_image');
Route::patch('items/{item}/edit_image', 'ItemController@update_image')->name('items.update_image');

//購入確認
Route::get('items/{item}/confirm', 'ItemController@confirm')->name('items.confirm');

//購入確定
Route::get('items/{item}/finish', 'ItemController@finish')->name('items.finish');
Route::post('items/purchase', 'ItemController@purchase')->name('items.purchase');

//お気に入り一覧
Route::get('likes', 'LikeController@index')->name('likes.index');
Route::patch('/items/{item}/toggle_like', 'ItemController@toggleLike')->name('items.toggle_like');


