<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_product_view extends Model
{
    public function product(){
		return $this->belongsTo('App\Model\Product');
	}
}
