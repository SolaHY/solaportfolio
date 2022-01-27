@extends('layouts.logged_in')
 
@section('content')
  <h1 class="like_title">{{ $title }}</h1>
 
  <ul class="items">
      @forelse($like_items as $item)
          <li class="item like_item">
            <div class="item_content">
              <div class="item_body">
                <div class="item_body_heading">
                  <div class="item_body_main">
                   <div class="item_body_main_img">
                    @if($item->image !== '')
                       <a href= "{{route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
                    @else
                        <img src="{{ asset('images/no_image.png') }}">
                    @endif
                   </div>
                 </div>
                 
                  <div>
                  商品名:{{ $item->name }} {{$item->price}}円
                  </div>
                  
                  <div>
                  カテゴリー:{{ $item->category->name ??''}}
                  ({{ $item->created_at }})
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
            </div>
          </li>
      @empty
          <li>お気に入り商品はありません。</li>
      @endforelse
  </ul>
  {{ $like_items->links() }}
@endsection