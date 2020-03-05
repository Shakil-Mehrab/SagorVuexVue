<?php

namespace App\Http\Controllers\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMembershipFormRequest;
use App\Model\Membership;
use App\Model\Membership_extra_image;
use Auth;
class MemberShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('layouts.pages.users.membership.index');
        $categories=Membership::where('user_id',auth()->user()->id)->first();
        return response()->json([
          'membership'=>$categories
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.pages.users.membership.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMembershipFormRequest $request)
    {
        $product=new Membership();
        $product->country_id=$request['country_id'];
        $product->city_id=$request['city_id'];
        $product->district_id=$request['district_id'];
        $product->company_name=$request['company_name'];
        $product->address=$request['address'];        
        $product->detail=$request['detail'];
        $product->category_id=$request['category_id']; 

        $image1=$request->file("image1");
         if($image1){
            $imag_extention=$image1->getClientOriginalExtension();
             $image_full_name=time().".".$imag_extention;
             $upload_path="images/membership/";
             $image_url=$upload_path.$image_full_name;
             $success=$image1->move($upload_path,$image_full_name);
            if($success){
              $product->image=$image_url;
            }
        }
        Auth::user()->membership()->save($product);
         $pdts=Membership::orderBy('id','desc')->limit(1)->get();
        foreach($pdts as $pd){
            $membership_id=$pd->id;
        } 
         if(!empty($images=$request->file("images"))){
          if(count($images)>0){
              foreach($images as $image){
               $image_name=str_random(10);
               $imag_extention=$image->getClientOriginalExtension();
               $image_full_name=$membership_id.".".$image_name.".".$imag_extention;
               $upload_path="images/membership/extra/";
               $image_url=$upload_path.$image_full_name;
               $success=$image->move($upload_path,$image_full_name);
                if($success){
                  $storage=new Membership_extra_image();
                  $storage->membership_id=$membership_id;
                  $storage->image=$image_url;
                    $storage->save();
                }
            }
        }
    }
        
      return redirect()->back()->withSuccess('Membership Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership=Membership::find($id);
        return view('layouts.pages.users.membership.edit',compact('membership')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMembershipFormRequest $request, $id)
    {
        $product=Membership::find($id);
        $product->country_id=$request['country_id'];
        $product->city_id=$request['city_id'];
        $product->district_id=$request['district_id'];
        $product->company_name=$request['company_name'];
        $product->address=$request['address'];        
        $product->detail=$request['detail'];
        $product->category_id=$request['category_id']; 
        $images=$request->file("images");
         $image1=$request->file("image1");
         if($image1){
             $imag_extention=$image1->getClientOriginalExtension();
             $image_full_name=$id.".".time().".".$imag_extention;
             $upload_path="images/membership/";
             $image_url=$upload_path.$image_full_name;
             $success=$image1->move($upload_path,$image_full_name);
            if($success){
              $product->image=$image_url;
            }
        }

       $product->update();
          if(!empty($images)){
              foreach($images as $image){
               $image_name=str_random(10);
               $imag_extention=$image->getClientOriginalExtension();
               $image_full_name=$id.".".$image_name.".".$imag_extention;
               $upload_path="images/membership/extra/";
               $image_url=$upload_path.$image_full_name;
               $success=$image->move($upload_path,$image_full_name);
                if($success){
                  $storage=new Membership_extra_image();
                  $storage->membership_id=$id;
                  $storage->image=$image_url;
                    $storage->save();
                }
            }
        }
    
      return redirect()->back()->withSuccess('Membership Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
