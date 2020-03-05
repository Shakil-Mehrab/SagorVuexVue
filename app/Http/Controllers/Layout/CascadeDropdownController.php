<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\City;
use App\Model\Countrycode;
use App\Http\Requests\DistrictStoreRequest;
use App\Model\District;
use App\Model\Area;

class CascadeDropdownController extends Controller
{
    public function show(Request $request)
    {
        if($request->has('country_id')){
           $cities=City::orderBy('name','asc')->where('country_id',$request->input('country_id'))->get();
           return $cities;
        }
    }
    public function codeShow(Request $request)
    {
        if($request->has('country_id')){
           $cities=Countrycode::orderBy('id','desc')->where('country_id',$request->input('country_id'))->get();
           return $cities;
        }
    }
    public function districtShow(Request $request)
    {
        if($request->has('city_id')){
           $cities=District::orderBy('name','asc')->where('city_id',$request->input('city_id'))->get();
           return $cities;
        }
    }
    public function areasShow(Request $request)
    {
        if($request->has('district_id')){
           $cities=Area::orderBy('name','asc')->where('district_id',$request->input('district_id'))->get();
           return $cities;
        }
    }
}
