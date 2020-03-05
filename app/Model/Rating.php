<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
   protected $fillable=['product_id','rating'];


   public function product(){
        return $this->belongsTo('App\Model\Product');
    }
}
