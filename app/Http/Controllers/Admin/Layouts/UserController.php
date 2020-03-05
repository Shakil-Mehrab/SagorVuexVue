<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Product;
use App\Model\Order;
use Auth;
class UserController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('admin.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);
        $pending_orders=Order::orderBy('id','desc')->where('user_id',$id)->where('delivered',0)->paginate(1);
        $orders_delivered=Order::orderBy('id','desc')->where('user_id',$id)->where('delivered',1)->paginate(1);
        return view('admin.pages.users.show',compact('user','pending_orders','orders_delivered'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $user=User::find($id);
        return view('admin.pages.users.input-edit.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $id)
    {
        $product=User::find($id);
        
        $product->name=$request['name'];
        $image=$request->file("image");
       if($image){
            $image_full_name=$image->getClientOriginalName();
             $upload_path="images/";
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
    $checkboxes=$request->checkboxes;
    if(!empty($checkboxes)){
      foreach($checkboxes as $chekbox_id){
        $property=User::find($chekbox_id);
          if(Auth::guard('admin') ){
            $property->delete();
            }else{
              return redirect()->back()->withError('You Are Not Authorized');
          }
      }
        return redirect()->back()->withSuccess('User Deleteed succesfully');
    }
      return redirect()->back()->withError('Please Select One');
   }
}
