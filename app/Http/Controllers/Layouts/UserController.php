<?php

namespace App\Http\Controllers\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\User;
use Session;
session_start();
use Auth;
class UserController extends Controller
{
    public function index()
    {
        // $user=User::find(auth()->user()->id);
        // return view('layouts.pages.users.index',compact('user'));
        $categories=User::find(auth()->user()->id);
        return response()->json([
          'user'=>$categories
        ],200);
    }
    public function show($id)
    {
        $user=User::find($id);
        $pending_orders=Order::orderBy('id','desc')->where('user_id',auth()->user()->id)->where('delivered',0)->paginate(1);
        $orders_delivered=Order::orderBy('id','desc')->where('user_id',auth()->user()->id)->where('delivered',1)->paginate(1);
        return view('layouts.pages.users.show',compact('user','pending_orders','orders_delivered'));
    }
    public function edit($id)
    {
        $user=User::find($id);
        return view('layouts.pages.users.input-edit.edit',compact('user'));
    }
    public function update(Request $request, $id)
    {
        $product=User::find($id);
        
        $product->name=$request['name'];
        $image=$request->file("image");
       if($image){
            $image_full_name=$image->getClientOriginalName();
             $upload_path="images/users/profile/";
             $image_url=$upload_path.$image_full_name;
             $success=$image->move($upload_path,$image_full_name);
            if($success){
             $product->image=$image_url;
           }
        }
        if(auth::user()->id==$id){
        $product->update();
            return back()->withSuccess('User Updated!');     
        }
        return back()->withError('You Are Not Permitted!');     
    }
    public function editcoverphoto($id)
    {
        $user=User::find($id);
        return view('layouts.pages.users.input-edit.edit-cover-photo',compact('user'));
    }
    public function updatecoverphoto(Request $request)
    {
        $product=User::find(auth::user()->id);
        // $product->name=$request['name'];

        $crope_image=Session::get('crope_image');
        $product->cover_photo="images/users/cover/".$crope_image;
        if($product->update()){
          $product->update();
          return back()->withSuccess('User Updated!');     
        }
        return back()->withError('You Are Not Permitted!');     
    }
    public function uploadImage(Request $request)
    {
        $image = $request->image;
        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);
        $image = base64_decode($image);
        $image_name= time().'.png';
        $path = public_path('images/users/cover/'.$image_name);
        file_put_contents($path, $image);
        Session::put('crope_image',$image_name);
        return response()->json(['status'=>true]);
    }
    
}
