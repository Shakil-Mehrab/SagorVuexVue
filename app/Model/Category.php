<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products(){
      return $this->hasMany('App\Model\Product')->where('status','approved')->latest();
    }
    public function fourproducts(){
      return $this->hasMany('App\Model\Product')->where('status','approved')->latest()->limit(4);
    }
    public function electronics(){
      return $this->hasMany('App\Model\Product')->where('status','approved')->latest();
    }
    public function fashion(){
      $total=Product::where('category_id','2')->where('status','approved')->get();
      $count=$total->count();
      return $this->hasMany('App\Model\Product')->where('status','approved')->limit($count/2)->latest();
    }
}
