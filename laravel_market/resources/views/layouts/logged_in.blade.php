@extends('layouts.default')
 
@section('header')
<header>
    <ul class="header_nav">
        <li>
          <a href="{{ route('items.index',Auth::user()) }}">
            Market
          </a>
        </li>
        
        <p>{{ Auth::user()->name }}さん、こんにちは！</p>
        
        <li>
          <a href="{{ route('users.show',Auth::user()) }}">
            プロフィール
          </a>
        </li>
        
        <li>
          <a href="{{ route('likes.index') }}">
            お気に入り一覧
          </a>
        </li>
        
        <li>
            <a href="{{ route('users.exhibitions' , Auth::user()) }}">
          出品商品一覧
          </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <input type="submit" value="ログアウト">
            </form>
        </li>
    </ul>
    <p class="catch">息をするように、買おう。</p>
</header>
@endsection