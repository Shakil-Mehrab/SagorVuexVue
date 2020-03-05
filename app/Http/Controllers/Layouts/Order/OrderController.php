<?php

namespace App\Http\Controllers\Layouts\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\User;
use Mail;
use App\Mail\OrderShipped;

class OrderController extends Controller
{
    public function Orders($type='')
    {
        if($type=='delivered'){
            $delivered=1;
            $orders=Order::orderBy('id','desc')->where('delivered','1')->paginate(5);
        }
        elseif($type=='pending'){
            $delivered=0;
            $orders=Order::orderBy('id','desc')->where('delivered','0')->paginate(5);
        }
        else{
            $orders=Order::all();
        }
     return view('layouts.pages.orders.index',compact('orders','delivered'));
    }
    public function toggleDelivered(Request $request, $order_id)
    {
        $this->validate($request,[
            "delivered"=>"required",
		 ]);
        $order=Order::find($order_id);
        if($request->has("delivered")){
            Mail::to($order->user)->send(new OrderShipped($order));
            $order->delivered=$request->delivered;
            $order->save();
            return back()->withSuccess("Order Delivered");
        }else{
            $order->delivered='0';
            $order->save();
            return back()->withError("Order Not Delivered");
        }
        
       
    }
    public function Delete(Request $request, $order_id)
    {
       $order=Order::find($order_id);
       $order->delete();
       return back()->withSuccess('Order Deleted!');     
    }

}


