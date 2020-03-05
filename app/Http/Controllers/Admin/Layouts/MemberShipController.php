<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Membership;
use Auth;
use App\Model\Product;

class MemberShipController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $users=Membership::all();
        return view('admin.pages.membership.index',compact('users'));
    }

    public function status(Request $request,$product_id)
    {
        $product=Membership::find($product_id);
        if($product->status=="approved"){
            $product->status='pending';
            $product->update();
            return back()->withSuccess('Status Pending');
        } 
         $product->status='approved';
            $product->update();
            return back()->withSuccess('Status Aproved');    

    }
    public function show($id)
    {
        $membership=Membership::find($id);
        $related_products = Product::orderBy('id','desc')->where('user_id',$id)->paginate(4);
        return view('admin.pages.membership.show',compact('membership','related_products'));
    }
    public function edit($id)
    {
         $user=Membership::find($id);
        return view('admin.pages.membership.edit',compact('user'));
    }

    public function updates(StoreMembershipFormRequest $request, $id)
    {
        $product=Membership::find($id);
        $product->country_id=$request['country_id'];
        $product->city_id=$request['city_id'];
        $product->district_id=$request['district_id'];
        $product->company_name=$request['company_name'];
        $product->address=$request['address'];        
        $product->detail=$request['detail'];
        $product->category_id=$request['category_id']; 

        $image1=$request->file("image1");
         if($image1){
             $image_full_name=$image1->getClientOriginalName();
             $upload_path="images/";
             $image_url=$upload_path.$image_full_name;
             $success=$image1->move($upload_path,$image_full_name);
            if($success){
              $product->image=$image_url;
            }
        }
         $image2=$request->file("image2");
         if($image2){
             $image_full_name=$image2->getClientOriginalName();
             $upload_path="images/";
             $image_url=$upload_path.$image_full_name;
             $success=$image2->move($upload_path,$image_full_name);
            if($success){
              $product->logo=$image_url;
            }
        }
       $product->update();
      return redirect()->back()->withSuccess('Membership Updated!');    

    }

    public function delete(Request $request){
    $checkboxes=$request->checkboxes;
    if(!empty($checkboxes)){
      foreach($checkboxes as $chekbox_id){
            $property=Membership::find($chekbox_id);
            $property->delete();
          }
        return redirect()->back()->withSuccess('User Deleteed succesfully');

      }

      return redirect()->back()->withError('Please Select One');
   }
}
