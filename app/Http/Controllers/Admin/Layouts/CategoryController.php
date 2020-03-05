<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryFormRequest;
use App\Model\Category;
use Image;

class CategoryController extends Controller
{
  public function __construct(){
    $this->middleware('auth:admin');
  }
  public function Index(){
    $categories=Category::all();
      return response()->json(['admincategories'=>$categories],200);
  }
  public function store(StoreCategoryFormRequest $request){
    $category=new Category();
    $category->name=$request->name;
    $strpos=strpos($request->image,';');
    $category->save();
     $agents=Category::orderBY('id','desc')->limit(1)->get();
      foreach ($agents as $agent){$id=$agent->id;}
      if($strpos){
        $product=Category::find($id);
        $image_name=time();
        $sub=substr($request->image,0,$strpos);
        $imag_extention=explode('/', $sub)[1];
        $image_full_name=$id.".".$image_name.".".$imag_extention;

        $img = Image::make($request->image);
        $img->resize(500, 500);
        $img->save('images/category/'.$image_full_name);
        $product->image='images/category/'.$image_full_name;
        $product->update();
      }
    return ['message'=>'category created'];
  }
  public function edit($id){
    $product=Category::find($id);
    return response()->json(['product'=>$product],200);
  }
  public function update(StoreCategoryFormRequest $request,$id){
    $product=Category::find($id);
    $product->name=$request['name'];
    $strpos=strpos($request->image,';');
     if($strpos){
      $image_name=time();
      $sub=substr($request->image,0,$strpos);
      $imag_extention=explode('/', $sub)[1];
      $image_full_name=$id.".".$image_name.".".$imag_extention;
      $img = Image::make($request->image);
      $img->resize(500, 500);
      // $img->insert('images/default/icon/icon.png');
      $img->save('images/category/'.$image_full_name);
      $product->image='images/category/'.$image_full_name;
    }
    $product->update();
    return ['message'=>'category updated'];     
  }
  public function delete(Request $request,$id){
    $category=Category::find($id);
    $category->delete();
    return ['message'=>'category deleted'];
  }
}


