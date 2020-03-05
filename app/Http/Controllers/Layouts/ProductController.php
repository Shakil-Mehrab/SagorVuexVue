<?php

namespace App\Http\Controllers\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreatedProductNotification;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\ImageStoreRequest;
use App\Notifications\NewPostNotify;
use App\Jobs\NewPostEmailQueue;
use App\Model\Product_video;
use Illuminate\Support\Str;
use App\Model\Subscriber;
use App\Model\Product;
use App\Model\Category;
use App\Model\Media;
use Carbon\Carbon;
use App\User;
use Auth;
use Image;
class ProductController extends Controller
{
    
/**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
     
    $categories=Product::with('user','category')->where('user_id',Auth::user()->id)->get();
    return response()->json(['products'=>$categories],200);
  }
  public function store(StoreProductFormRequest $request)
  {
      $product=new Product();
      $product->name=$request['name'];
      $product->brand=$request['brand'];        
      $product->price=$request['price']; 
      $product->qty=$request['qty'];
      $product->min_order=$request['min_order'];
      $product->max_order=$request['max_order'];
      $product->discount=$request['discount'];        
      $product->detail=$request['detail'];
      $product->size=$request['size'];
      $product->category_id=$request['category_id']; 
      Auth::user()->products()->save($product);
      $pdts=Product::orderBy('id','desc')->where('user_id',Auth::user()->id)->limit(1)->get();
      foreach($pdts as $pd){
          $product_id=$pd->id;
          // $product->user->notify(new CreatedProductNotification($pd)); //ekhane id pass korar jonno eta kora
      } 
      return response()->json(['product'=>$product_id],200);          
  }
  public function show($id)
  {
      $product=Product::find($id);
      $categories=Category::all();
      $medias=Media::where('product_id',$id)->get();
      return view('layout.pages.products.single.index',compact('product','categories','medias'));
  }
  public function edit($id)
  {
    $product=Product::find($id);
    return response()->json(['product'=>$product],200);
  }
  public function updates(StoreProductFormRequest $request,$id)
  {

      $product=Product::find($id);
      $product->name=$request['name'];
      $product->brand=$request['brand'];        
      $product->price=$request['price']; 
      $product->qty=$request['qty'];
      $product->min_order=$request['min_order'];
      $product->max_order=$request['max_order'];
      $product->discount=$request['discount'];        
      $product->detail=$request['detail'];
      $product->size=$request['size'];
      $product->category_id=$request['category_id']; 
      $product->update();
       $pdts=Product::orderBy('id','desc')->where('user_id',Auth::user()->id)->limit(1)->get();
      foreach($pdts as $pd){
          $product_id=$pd->id;
          // $product->user->notify(new CreatedProductNotification($pd));
      } 
      return response()->json(['product'=>$product_id],200);                 
  }
   public function updateproductimage(Request  $request,$id)
  {
      $product=Product::find($id);
      $images=$request->file("images");
      $strpos=strpos($request->image1,';');
       if($strpos){
           $image_name=Str::random(10);
           $sub=substr($request->image1,0,$strpos);
           $imag_extention=explode('/', $sub)[1];
           $image_full_name=$id.".front.".$image_name.".".$imag_extention;

              $img = Image::make($request->image1);
              $img->resize(500, 500);
              // $img->insert('images/default/icon/icon.png');
              $img->save('images/front&back/croped/'.$image_full_name);
            $product->image1='images/front&back/croped/'.$image_full_name;
         $product->save();
      }
      
    return ["message"=>"Image Updated"];          
  }

}
