<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\UpdateProductRequest;
use App\Notifications\NewPostNotify;
use App\Notifications\CreatedProductNotification;
use App\Model\Product_video;
use App\Model\Subscriber;
use App\Model\Product;
use App\Model\Category;
use Auth;

class ProductController extends Controller
{
  public function __construct(){
    $this->middleware('auth:admin');
  }
  public function index(){
    $categories=Product::with('user','category')->get();
    return response()->json(['adminproducts'=>$categories],200);
  }
  public function show($id){
    $product=Product::find($id);
    $categories=Category::all();
    return view('layout.pages.products.single.index',compact('product','categories'));
  }
  public function edit($id){
    $product=Product::find($id);
    return response()->json(['product'=>$product],200);
  }
  public function update(UpdateProductRequest $request,$id){
    $total=$request['price']+$request['extra_price'];
    $subscribers=Subscriber::all();
    $product=Product::find($id);
    $product->name=$request['name'];
    $product->brand=$request['brand'];  
    $product->extra_price=$request['extra_price']; 
    $product->price=$total; 
    $product->vat=$request['vat']*$total/100; 
    $product->position=$request['position']; 
    $product->qty=$request['qty'];
    $product->min_order=$request['min_order'];
    $product->max_order=$request['max_order'];
    $product->discount=$request['discount']*$request['price']/100;        
    $product->detail=$request['detail'];
    $product->size=$request['size'];
    $product->category_id=$request['category_id']; 
    $product->update();
    return["message"=>"product update"];      
  }
  public function status($id){
    $product=Product::find($id);
    if($product->status=="approved"){
      $product->status='pending';
      $product->update();
      return ["message"=>"status pending"];
    } 
    $product->status='approved';
    $product->update();
    return ["message"=>"status approved"];    
  }
  public function delete($id){
    $property=Product::find($id);
    $property->delete();
    return ['message'=>'product deleted'];
  }
  public function editpdtimg($id){
    $categories=Category::all();
    $product=Product::find($id);
    return view('admin.pages.products.input-edit.edit_image',compact('categories','product'));
  }
  public function updatepdtimg(Request  $request,$id){
       
  }

}
