@extends('layouts.logged_in')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>

@if($user->image !== '')
   <img src="{{ asset('storage/' . $user->image) }}">
@else
   <img src="{{ asset('images/no_image.png') }}">
@endif
   [<a href="{{ route('profile.edit_image', $user) }}">画像を変更</a>]

<p>{{ Auth::user()->name }}さん<a href="{{ route('profile.edit', $user) }}">プロフィール編集</a></p>
<div>
  <h3>自己紹介</h3>
  {{ $user->profile }}
</div>

@if($itemCount !== '')
<p>
   出品数:{{$itemCount}}
</p>
@else
    <li>出品している商品はありません。</li>
@endif

<h3>
  購入履歴
</h3>
<ul>
@forelse($orders as $order)
  <li>
  {{$order->item->name}}: {{$order->item->price}}円  出品者 {{$order->item->user->name}}さん
  </li>
@empty
  <li>購入した商品はありません。</li>
@endforelse
</ul>
@endsection