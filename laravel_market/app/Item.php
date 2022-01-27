<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model

{
    protected $fillable = [
        'name', 'user_id' ,  'description', 'price', 'category_id' , 'image'
    ];
    
    public function category() {
        return $this -> belongsTo ('App\Category');
    }
    
    public function user() {
        return $this -> belongsTo ('App\User');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function likedUsers(){
      return $this->belongsToMany('App\User', 'likes');
    }
    
    public function likedItems(){
      return $this->belongsToMany('App\Item', 'likes');
    }
    
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    
    public function isSoldOut() {
        return $this->hasMany ('App\Order')->count() >0 ;
    }
   
}