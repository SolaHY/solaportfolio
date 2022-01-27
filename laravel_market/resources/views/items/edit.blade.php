@extends('layouts.logged_in')

@section('title', $title)
 
@section('content')
  <h1>{{ $title }}</h1>
  <h2>商品追加フォーム</h2>
  <form method="POST" action="{{ route('items.update', $item) }}" >
      @csrf
      @method('PATCH')
      <div>
          <label>
            商品名:
            <div>
            <input type="text" name="name" value="{{$item->name}}">
            </div>
          </label>
      </div>
      
      <div>
          <label>
            商品説明:
            <div>
            <textarea cols='50' rows='10' name="description">{{$item->description}}</textarea>
            </div>
          </label>
      </div>
      
      <div>
          <label>
            価格:
            <div>
            <input type="text" name="price" value="{{$item->price}}">
            </div>
          </label>
      </div>

      <div class="form-group">
        <label for="category-id">{{ __('カテゴリー:') }}</label>
        <select class="form-control" id="category-id" name="category_id">
            @foreach ($categories as $category)
                <option {{$item->category_id === $category->id ? 'selected' :''}} value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
      </div>
        <input type="submit" value="更新">
    </form>
@endsection