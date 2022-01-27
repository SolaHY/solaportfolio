@extends('layouts.not_logged_in')
 
@section('content')
  <h1>ユーザー登録</h1>
 
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <div>
      <label>
        ユーザー名:
        <div>
        <input type="text" name="name">
        </div>
      </label>
    </div>
    
    <div>
      <label>
        メールアドレス:
        <div>
        <input type="email" name="email">
        </div>
      </label>
    </div>
    
    <div>
      <label>
        パスワード:
        <div>
        <input type="password" name="password">
        </div>
      </label>
    </div>
    
    <div>
      <label>
        パスワード（確認用）:
        <div>
        <input type="password" name="password_confirmation" >
        </div>
      </label>
    </div>
 
    <div>
      <input type="submit" value="登録">
    </div>
  </form>
@endsection