<?php

namespace App\Http\Controllers\Layout\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressFormRequest;
use App\Http\Requests\StoreTrasactionNo;
use App\Model\Product;
use App\Model\Order;
use App\Model\Address;
use App\Model\Billing;
use App\Mail\OrderConfirmed;
use Cart;
use Auth;
use Mail;
use Session;

class CartController extends Controller
{
public function index(){
   $cartItems=Cart::getContent();
   return view('layout.pages.cart.cart',compact('cartItems'));
}
public function addItem(Request $request,$id){
  $product=Product::find($id);
  if($product->qty>0){
  $subtotal=Cart::getSubTotal();
    Cart::add([
        'id' => $id,
        'name' => $product->name,
        'price' => $product->price-$product->discount,
        'quantity' => $product->min_order,
        'attributes' =>[
            'size' => 'Large',
            'image' => $product->image1,
            'vat' => $product->vat,
             ],      
    ]);
    return back();
  }
  return back()->withError('Not Available');
}
public function update(Request $request, $id){
  $product=Product::find($id);
  $subtotal=Cart::getSubTotal();
  if($request->quantity<$product->min_order){return back()->withError('Order Minimum'.$product->min_order);}
    Cart::update($id,array(
        'quantity'=>array(
            'relative' => false,
            'value'=>$request->quantity,
            ),
        'attributes' => array(
            'size' => $request->size,
            'image' => $product->image1,
            'vat' => $product->vat,
             ),
        ));
    return back()->withSuccess('Cart Updated !');
}

public function destroy($id){
  Cart::remove($id);
  return back()->withSuccess('Cart Removed !');
}

//shipping
public function shipping(){
    $cartItems=Cart::getContent();
    if(count($cartItems)>0){
      return view('layout.pages.cart.shipping');
    }else{return redirect('/');}
}

public function BkashPaymentStore(StoreAddressFormRequest $request){
     $cartItems=Cart::getContent();
    if(count($cartItems)>0){
         $shipping_info=new Address();
         $shipping_info->full_name=$request['full_name'];
         $shipping_info->phone_no=$request['phone_no'];
         $shipping_info->country_id=$request['country_id'];
         $shipping_info->city_id=$request['city_id'];
         $shipping_info->district_id=$request['district_id'];
         $shipping_info->area_id=$request['area_id'];
         $shipping_info->address=$request['address'];
         $shipping_info->note=$request['note'];
         $request->user()->address()->save($shipping_info);
        return redirect('/product/payment/method');
    }else{return redirect('/');}
}



//payment method
  public function PaymentMethod(){
    $address=Address::orderBy('id','desc')->where('user_id',auth()->user()->id)->limit(1)->get();
    foreach($address as $addres){$shippingCharge=$addres->area->charge;}
    $cartItems=Cart::getContent();
    if(count($cartItems)>0){
        return view('layout.pages.cart.payment-method',compact('cartItems','shippingCharge'));
    }else{return redirect('/');}
    } 


    public function confirmOrder(Request $request){
        $method=$request['method'];
        $vat=Session::get('vat');
        $shippingCharge=Session::get('shippingCharge');
        Order::createOrder($method,$vat,$shippingCharge);
        $cartItems=Cart::getContent();
        foreach($cartItems as $cartItem){
            Cart::remove($cartItem->id);
        } 
        
    return view('layout.pages.cart.confirm-order')->withSuccess('Order Is Done! Now Confirm It Or Make Later!');
   }

    public function TransactionNo(StoreTrasactionNo $request,$order_id){
         $confirmed_order=Order::find($order_id);
         Mail::to($confirmed_order->user)->send(new OrderConfirmed($confirmed_order));
         $confirmed_order->transaction_no=$request['transaction_no'];
         $confirmed_order->update();
         return view('layout.pages.cart.thankto');

   }



}

