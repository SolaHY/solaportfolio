@extends('layouts.logged_in')

@section('title', $title)

@section('content')
    <h1>{{ $title }}</h1>
    <form method="post" action="{{ route('users.update') }}">
        @csrf
        @method('patch')
        <div>
            <label>
                名前:
                <input type="text" name="name" value="{{ $user->name }}">
            </label>
        </div>
        <div>
            <label>
                プロフィール:
                <textarea name="profile" rows="5" cols="100">{{ $user->profile }}</textarea>
            </label>
        </div>
        <p><input type="submit" value="更新"></p>
    </form>
@endsection