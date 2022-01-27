@extends('layouts.logged_in')
 
@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data" >
      @csrf
      <div>
          <label>
            商品名:
            <div>
            <input type="text" name="name">
            </div>
          </label>
      </div>
      
      <div>
          <label>
            商品説明:
            <div>
            <textarea type="text" name="description" rows="5" cols="80"></textarea>
            </div>
          </label>
      </div>
      
      <div>
        <label>
          価格:
          <div>
          <input type="text" name="price">
          </div>
        </label>
      </div>
      
      <div class="form-group">
        <label for="category-id">{{ __('カテゴリー') }}</label>
        <select class="form-control" id="category-id" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
      </div>
      
      <div>
        <label>
            画像を選択:
            <input type="file" name="image">
        </label>
      </div>
 
      <input type="submit" value="出品">
  </form>
@endsection