<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Country;
use App\Http\Requests\StoreCategoryFormRequest;
use App\Http\Requests\CityStroreRequest;
use App\Http\Requests\DistrictStoreRequest;
use App\Http\Requests\AreaStoreRequest;
use App\Model\City;
use App\Model\District;
use App\Model\Area;
use Image;
class CountryController extends Controller
{
    public function __construct(){
      $this->middleware('auth:admin');
    }
    public function Index(){
      $categories=Country::all();
      return response()->json(['admincountries'=>$categories],200);
    }
    public function store(StoreCategoryFormRequest $request){
      $agent=new Country();
      $agent->name=$request['name'];
      $strpos=strpos($request->image,';');
      $agent->save();
      $agents=Country::orderBY('id','desc')->limit(1)->get();
      foreach ($agents as $agent){$id=$agent->id;}
       if($strpos){
          $product=Country::find($id);
          $image_name=time();
          $sub=substr($request->image,0,$strpos);
          $imag_extention=explode('/', $sub)[1];
          $image_full_name=$id.".".$image_name.".".$imag_extention;

          $img = Image::make($request->image);
          $img->resize(500, 500);
          // $img->insert('images/default/icon/icon.png');
          $img->save('images/country/'.$image_full_name);
          $product->image='images/country/'.$image_full_name;
          $product->update();
      }
      return ["message"=>"country created"];
    }
    public function edit($id){
      $product=Country::find($id);
      return response()->json(['product'=>$product],200);
    }
    public function update(StoreCategoryFormRequest $request,$id){
      $product=Country::find($id);
      $product->name=$request['name'];
      $product->pavilion=$request['pavilion'];
      $strpos=strpos($request->image,';');
       if($strpos){
          $image_name=time();
          $sub=substr($request->image,0,$strpos);
          $imag_extention=explode('/', $sub)[1];
          $image_full_name=$id.".".$image_name.".".$imag_extention;

          $img = Image::make($request->image);
          $img->resize(500, 500);
          // $img->insert('images/default/icon/icon.png');
          $img->save('images/country/'.$image_full_name);
          $product->image='images/country/'.$image_full_name;
      }
      $product->update();
      return ["message"=>"ok"];
    }
    public function delete($id){
      $property=Country::find($id);
      $property->delete();
      return ["message"=>"country deleted"];
    }










  public function city(){
    $categories=City::with('country')->get();
    return response()->json(['admincities'=>$categories],200);
  }
  public function  cityStore(CityStroreRequest $request){
    $agent=new City();
    $agent->name=$request['name'];
    $agent->country_id=$request['country_id'];
    $agent->save();
    return ["message"=>"city created"];
  }
  public function cityEdit($id){
    $product=City::find($id);
    return response()->json(['product'=>$product],200);
  }
  public function cityUpdate(CityStroreRequest $request,$id){
    $agent=City::find($id);
    $agent->name=$request['name'];
    $agent->country_id=$request['country_id'];
    $agent->update();
    return ["message"=>"city updatae"];
  }
  public function cityDelete($id){
      $property=City::find($id);
      $property->delete();
      return ["message"=>"country updatae"];
  }






   public function district(){
      $categories=District::orderBY('city_id','desc')->orderBy('name','asc')->with('city','city.country')->get();
      return response()->json(['admindistricts'=>$categories],200);
    }

    public function  districtStore(DistrictStoreRequest $request){
      $agent=new District();
      $agent->name=$request['name'];
      $agent->city_id=$request['city_id'];
      $agent->save();
      return redirect()->back()->withSuccess('District Created succesfull');
    }
    public function districtUpdate(DistrictStoreRequest $request,$agent_id){
        $product=District::find($agent_id);
        $product->name=$request['name'];
        $product->city_id=$request['city_id'];
        $product->update();
        return back()->withSuccess('District Updated');     
   }
    public function districtDelete(Request $request,$id){
        $property=District::find($id);
        $property->delete();
        return redirect()->back()->withSuccess('District Deleted succesfully');
   }
   
   
   
   public function area(){
      $categories=Area::orderBY('district_id','desc')->orderBy('name','asc')->get();
      return view("admin.pages.countries.area.index",compact(['categories']));
    }

    public function  areaStore(AreaStoreRequest $request){
      $agent=new Area();
      $agent->name=$request['name'];
      $agent->charge=$request['charge'];
      $agent->district_id=$request['district_id'];
      $agent->save();
      return redirect()->back()->withSuccess('Area Created succesfull');
    }
    public function areaUpdate(AreaStoreRequest $request,$agent_id){
        $product=Area::find($agent_id);
        $product->name=$request['name'];
        $product->charge=$request['charge'];
        $product->district_id=$request['district_id'];
        $product->update();
        return back()->withSuccess('Area Updated');     
   }
    public function areaDelete(Request $request,$id){
        $property=Area::find($id);
        $property->delete();
        return redirect()->back()->withSuccess('Area Deleted succesfully');
   }

}


