<?php
 
namespace App;
 
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

 
class User extends Authenticatable
{
    use Notifiable;
 
 
    protected $fillable = [
        'name', 'email', 'password', 'profile', 'image'
    ];
 
    protected $hidden = [
        'password', 'remember_token',
    ];
 
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function user(){
      return $this->belongsTo('App\User');
    }
    
      public function items(){
        return $this->hasMany('App\Item');
    }
    
    public function likes(){
      return $this->hasMany('App\Like');
    }
    
    public function likeItems(){
      return $this->belongsToMany('App\Item', 'likes')->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }
    
    public function order(){
      return $this->hasMany('App\Order');
    }
    
   
}