<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User_product_view;
use App\Jobs\UserViwedNews;
use App\Model\Product;
use App\Model\Category;
use App\Model\Review;
use App\Model\Video;
class SingleProductController extends Controller
{
    // public function quickview(Request $request,$detail_id){
    //     $new=Product::find($detail_id);
    //     if($request->user()){dispatch(new UserViwedNews($request->user(),$new));}  
    //     $single_product=Product::find($detail_id);
    //     $reviews=Review::orderBy('id','asc')->limit(20)->get();
    //     $videos=Video::all();
    //     $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get(); 
    //     return view('layout.pages.products.single.quick-view',compact('single_product','reviews','videos','popular_products'));
    // }
    public function show(Request $request,$detail_id)
    {
        $new=Product::find($detail_id);
        if($request->user()){dispatch(new UserViwedNews($request->user(),$new));}  
        $single_product=Product::find($detail_id);
        $videos=Video::all();
        $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get(); 
        return view('layout.pages.products.single.index',compact('single_product','videos','popular_products'));
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = trim($request->get('query'));
      $cat = trim($request->get('cat'));
      if($query !='')
      {
        if($cat!=0){
       $data = Product::where('name', 'like', '%'.$query.'%')->where('category_id',$cat)
         // ->orWhere('Address', 'like', '%'.$query.'%')
         // ->orWhere('City', 'like', '%'.$query.'%')
         // ->orWhere('PostalCode', 'like', '%'.$query.'%')
         // ->orWhere('Country', 'like', '%'.$query.'%')
         // ->orderBy('CustomerID', 'desc')
         ->get();
         }
         else{
          $data = Product::where('name', 'like', '%'.$query.'%')
         // ->orWhere('Address', 'like', '%'.$query.'%')
         // ->orWhere('City', 'like', '%'.$query.'%')
         // ->orWhere('PostalCode', 'like', '%'.$query.'%')
         // ->orWhere('Country', 'like', '%'.$query.'%')
         // ->orderBy('CustomerID', 'desc')
         ->get();
         }
      }
      else
      {
       $data = " ";
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       $output = '
        <div style="background:white">
           <li style="margin:5px;font-size:15px;margin-bottom:-12px;float:right"><span class="label label-danger" onclick="searchClear()"><i class="fa fa-times"></i></span></li>
        </div>';
       foreach($data as $row)
       {
        $output .= '
        <div style="background:white">
         <li style="margin:12px;font-size:15px"><a href="/single-product/'.$row->id .'"><span>'.$row->name .'</span></a>
         </li>
        <div>
        
        ';
       }
      }
      else
      {
       $output = '
       <div style="background:white;margin-top:12px;color:black">
         <li><span style="color:black;padding:2px"> No Result Found</span></li>
        <div>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
