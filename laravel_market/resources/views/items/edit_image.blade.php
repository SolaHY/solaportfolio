@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>現在の画像</h2>
  <form method="POST" action="{{ route('items.update_image',$item) }}" enctype="multipart/form-data" >
      @csrf
      @method('PATCH')
      @if($item->image === '')
      <img src="{{asset('images/no_image.png')}}">
      @else
      <img src="{{\Storage::url($item->image)}}">
      @endif
      <div>
            <label>
                画像を選択:
                <input type="file" name="image">
            </label>
      </div>
     <input type="submit" value="更新">
  </form>
@endsection