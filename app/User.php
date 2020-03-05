<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     public function categories(){
        return $this->hasMany('App\Model\Category');
    }
      public function address(){
        return $this->hasMany('App\Model\Address');
    }
    public function products()
    {   
        return $this->hasMany('App\Model\Product');
    }
     public function membership()
    {   
        return $this->hasOne('App\Model\Membership');
    }
    public function orders(){
        return $this->hasMany('App\Model\Order');
    }
    public function likes()
    {   
        return $this->hasMany('App\Model\Like');
    }
    public function reviews(){
        return $this->hasMany('App\Model\Review');
    }
    public function replies(){
        return $this->hasMany('App\Model\Reply');
    }
    public function chats(){
        return $this->hasMany('App\Model\Chat');
    }
    public function medias()
    {   
        return $this->hasMany('App\Model\Media');
    }
    public function viewedListings(){
       return $this->belongsToMany(Product::class ,'user_product_views')->withTimestamps()->withPivot(['count','id']);
    } 

     public function billings()
    {   
        return $this->hasMany('App\Model\Billing');
    }
    public function ratings(){
        return $this->hasMany('App\Model\Rating');
    }
      public function ExistUserRating(){
       return $this->belongsToMany(Product::class ,'user_product_ratings')->withTimestamps()->withPivot(['rating','id']);
    } 
    public function country(){
        return $this->belongsTo('App\Model\Country');
    }
    public function city(){
        return $this->belongsTo('App\Model\City');
    }
     public function district(){
        return $this->belongsTo('App\Model\District');
    }
}
