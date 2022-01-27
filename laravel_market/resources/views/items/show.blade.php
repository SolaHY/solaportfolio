@extends('layouts.logged_in')

@section('content')
  <h1>{{ $title }}</h1>
  <ul class="items">
    <li class="item">
      <div class="item_content">
        <div class="item_body">
          <div class="item_detail">
             商品名
             </div>
             <div> 
               {{ $item->name }} 
             </div>
          
            <div class="item_detail">
             画像
            </div>
            <div> 
            @if($item->image !== '')
              <img src="{{ asset('storage/' . $item->image) }}">
            @else
              <img src="{{ asset('images/no_image.png') }}">
            @endif 
            </div>
          </div>
          
           <div class="item_detail">
              カテゴリー
              </div>
              <div> 
              {{ $item->category->name }}
              </div>
           </div>
           
          <div class="item_detail">
              価格
              </div>
              <div> 
              {{$item->price}}円
              </div>
          </div>
          
          <div class="item_detail">
              説明
              </div>
              <div> 
              {{ $item->description }} 
              </div>
          </div>
          
           <div>
                @if($item ->isSoldOut() == true)
                売り切れ
               @else
               [<a href="{{ route('items.confirm', $item) }}">購入する</a>]
               @endif
               </div>
      </div>
    </li>
  </ul>
@endsection