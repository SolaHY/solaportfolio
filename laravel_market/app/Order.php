<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     public $fillable = ['name', 'user_id', 'item_id'];
     
     public function order(){
      return $this->belongsTo('App\User', 'order');
    }
    
     public function item(){
      return $this->belongsTo('App\Item');
    }
}
