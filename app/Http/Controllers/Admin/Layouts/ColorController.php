<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Color;
use App\Http\Requests\StoreCategoryFormRequest;
use App\Model\Category;
use App\Model\Product;
use Auth;

class ColorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth:admin');
    }
	 public function Index(){
        $categories=Color::orderBY('id','desc')->get();
        return view("admin.pages.color.index",compact(['categories']));
    }

    public function store(StoreCategoryFormRequest $request){
      $agent=new Color();
      $agent->name=$request['name'];
      $agent->save();
      return redirect()->back()->withSuccess('Color Created succesfull');
    }

    public function update(StoreCategoryFormRequest $request,$agent_id){
      $agent=Color::find($agent_id);
      $agent->name=$request['name'];
      $agent->update();
      return redirect()->back()->withSuccess('Color Updated succesfull');
  }

    public function delete(Request $request){
    $checkboxes=$request->checkboxes;
    if(!empty($checkboxes)){
      foreach($checkboxes as $chekbox_id){
        $property=Color::find($chekbox_id);
        $property->delete();
      }
        return redirect()->back()->withSuccess('Color Deleteed succesfully');
    }
      return redirect()->back()->withError('Please Select One');
   }
}


