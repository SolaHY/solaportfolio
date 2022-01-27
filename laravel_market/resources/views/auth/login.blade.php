@extends('layouts.not_logged_in')
 
@section('content')
  <h1>ログイン</h1>
 
  <form method="POST" action="{{ route('login') }}">
      @csrf
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
            <input type="password" name="password" >
            </div>
          </label>
      </div>
 
      <input type="submit" value="ログイン">
  </form>
@endsection