@extends('layouts.logged_in')

@section('content')
  <h1>{{ Auth::user()->name }}の{{ $title }}</h1>
  <div class="create">
  <a href="{{route('items.create')}}">新規出品</a>
  </div>
  <ul class="items">
    @forelse($items as $item)
    <li class="item">
      <div class="item_content">
        <div class="item_body">
          <div class="item_body_main_img">
            @if($item->image !== '')
           <a href= "{{route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
            @else
            <img src="{{ asset('images/no_image.png') }}">
            @endif
            </div>
            
           <div class="description">
             商品説明:{{ $item->description }}
           </div>
          </div>
          
          <div class="item_body_heading">
            商品名:{{ $item->name }} {{$item->price}}円
          </div>
  
          <div class="item_body_main">
            カテゴリー:{{ $item->category->name }}
            ({{ $item->created_at }})
          </div>
          [<a href="{{ route('items.edit', $item) }}">編集</a>]
          [<a href="{{ route('items.edit_image', $item) }}">画像を変更</a>]
          <div><form class="delete" method="post" action="{{ route('items.destroy', $item) }}">
            @csrf
            @method('DELETE')
            <input class="del_button" type="submit" value="削除">
          </form>
          </div>
          
           <div>
               @if($item ->isSoldOut() == true)
               売り切れ
               @else
               出品中
               @endif
            </div>
        </div>
      </div>
    </li>
    @empty
    <li>出品している商品はありません。</li>
    @endforelse
  </ul>
  {{ $items->links() }}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection