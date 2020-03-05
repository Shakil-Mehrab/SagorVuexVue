<?php

namespace App\Http\Controllers\Admin\Layouts\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Order_product;

use App\User;
use Mail;
use App\Mail\OrderShipped;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function Orders($type='')
    {
        if($type=='delivered'){
            $orders=Order::where('delivered','1')->paginate(1);
        }
        elseif($type=='pending'){
        $orders=Order::where('delivered','0')->paginate(1);
        }
        else{
            $orders=Order::orderBy('id','desc')->paginate(2);
        }
     return view('admin.pages.orders.index',compact('orders'));
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
            foreach ($order->orders_products as $value) {
                $order_product=Order_product::find($value->id);
                $order_product->delivered=1;
                $order_product->save();
            }
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


