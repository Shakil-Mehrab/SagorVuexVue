<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSlideFormRequest;
use App\Notifications\NewPostNotify;
use App\Model\Subscriber;
use App\Model\Category;
use App\Model\Slide;
use Image;
use Auth;

class SlideController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $products=Slide::orderBy('id','desc')->get();
        return view("admin.pages.slide.index",compact('products'));
    }
    public function create()
    {
        $categories=Category::all();
        return view('admin.pages.slide.input-edit.create',compact('categories'));
    }
    public function store(StoreSlideFormRequest $request)
    {
        $product=new Slide();
        $product->name=$request['name'];        
        $product->save();
        return redirect()->back()->withSuccess('Slide Created!');             
    }
  
    public function show($id)
    {
        $product=Slide::find($id);
        $categories=Category::all();
        return view('layout.pages.slide.single.index',compact('product','categories'));
    }
    public function edit(Request $request,$id)
    {
        $product=Slide::find($id);
        $categories=Category::all();
        return view('admin.pages.slide.input-edit.edit',compact('product','categories'));
    }
     public function update(StoreSlideFormRequest $request,$product_id)
    {
        
        $product=Slide::find($product_id);
        $product->name=$request['name'];        
        $image=$request->file("image");
         if($image){
             $imag_extention=$image->getClientOriginalExtension();
             $image_full_name=$product_id.".".time().".".$imag_extention;
             $upload_path="images/slides/";
             $image_url=$upload_path.$image_full_name;
             $success=$image->move($upload_path,$image_full_name);
            if($success){
                $img = Image::make($image_url);
                $img->resize(1024, 310);
                // $img->insert('images/default/icon/icon.png');
                $img->save('images/slides/croped/'.$image_full_name);
              $product->image='images/slides/croped/'.$image_full_name;
            }
        }
        $product->update();
        return redirect()->back()->withSuccess('Slide Updated!'); 
    }
    public function delete(Request $request,$id){
        $property=Slide::find($id);
        $property->delete();
        return redirect()->back()->withSuccess('Slide Deleteed succesfully');
   }
}
