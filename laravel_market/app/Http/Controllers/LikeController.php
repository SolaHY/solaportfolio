<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Like;
use App\User;

class LikeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // お気に入り一覧
    public function index()
    {
        $like_items = \Auth::user()->likeItems()->paginate(5);
        return view('likes.index', [
          'title' => 'お気に入り一覧',
          'like_items' => $like_items,
          
        ]);
    }
    
}

