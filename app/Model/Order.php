<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Cart;
use App\User;
use App\Model\Order_product;
use App\Model\Address;

class Order extends Model
{
  protected $fillable=['total','delivered','address_id','payment_method'];
  public function orderItems(){
    return $this->belongsToMany(Product::class,'order_products')->withTimestamps()->withPivot('qty','delivered','size','total');
  }
  //i am not sure about this
  public function order_product(){
    return $this->hasOne(Order_product::class);
  }
  //this is newly created
   public function orders_products(){
    return $this->hasMany(Order_product::class);
  }
   public function user(){
    return $this->belongsTo(User::class);
  }
  public function address(){
      return $this->belongsTo('App\Model\Address');
  }
  public static function createOrder($v,$vat,$shippingCharge){
  $subtotal=Cart::getSubTotal();
    $total=Cart::getSubTotal()+$vat+$shippingCharge;
    
    $user=Auth::user();
    $address=Address::OrderBy('id','desc')->where('user_id',$user->id)->limit(1)->get();  
    foreach($address as $addres){
      $addres_id=$addres->id;
    }
    $check=Order::where('user_id',auth()->user()->id)->where('address_id',$addres_id)->first();
    if(empty($check)){
    $user=Auth::user();
    $order=$user->orders()->create([
      'total'=>$total,
      'address_id'=>$addres_id,
      'delivered'=>0,
      'payment_method'=>$v,

    ]);
    $cartItems=Cart::getContent();
    foreach($cartItems as $cartItem){
      $product=Product::find($cartItem->id);
      $product->qty=$product->qty-$cartItem->quantity;
      $product->update();
        $order->orderItems()->attach($cartItem->id,[
            'qty'=>$cartItem->quantity,
            'delivered'=>0,
            'size'=>"Large",
            'total'=>$cartItem->quantity*$cartItem->price+$cartItem->quantity*$cartItem->quantity*$product->vat,
        ]);
    }
   }//end check
  }
}