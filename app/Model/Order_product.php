<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Product;
use App\Model\Order;

class Order_product extends Model
{
    public function product(){
    	return $this->belongsTo(Product::class);
    }
    public function order(){
    	return $this->belongsTo(Order::class);
    }
    
}
