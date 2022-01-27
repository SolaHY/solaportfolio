@extends('layouts.logged_in')
 
@section('content')
  <h1>{{ $title }}</h1>
  <div class="create">
  <a href="{{route('items.create')}}">新規出品</a>
  </div>
  <ul class="items">
      @forelse($items as $item)
          <li class="item">
            <div class="item_content">
              <div class="item_body">
                <div class="item_body_heading">
                  <div class="item_body_main">
                  <div class="item_body_main_img">
                    @if($item->image !== '')
                      <a href= "{{route('items.show', $item)}}"><img src="{{ asset('storage/' . $item->image) }}"></a>
                    @else
                        <a><img src="{{ asset('images/no_image.png') }}"></a>
                    @endif
                    </div>
                    
                  <div>
                  商品説明:{{ $item->description }}
                  </div>
                </div>
                
                <div>
                  商品名:{{ $item->name }} {{$item->price}}円
                  <a class="like_button">{{ $item->isLikedBy(Auth::user()) ? '★' : '☆' }}</a>
                  <form method="post" class="like" action="{{ route('items.toggle_like', $item) }}">
                    @csrf
                    @method('patch')
                  </form>
                </div>
                
                <div>
                  カテゴリー:{{ $item->category->name }}
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
          <li>商品はありません。</li>
      @endforelse
  </ul>
  {{ $items->links() }}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    /* global $ */
    $('.like_button').each(function(){
      $(this).on('click', function(){
        $(this).next().submit();
      });
    });
  </script>
@endsection