<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slide;
use App\Model\Product;
use App\Model\User_product_view;
use App\Model\Rating;
use App\Model\Category;
use App\Model\Video;
use App\Model\Product_video;
class CategoryController extends Controller
{
    public function category($id)
    {
        $category=Category::find($id);
        $latest_products=Product::orderBY('id','desc')->where('status','approved')->limit(5)->get();
        $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get();

        return view("layout.pages.category.category",compact('category','popular_products','latest_products'));
    }
   
}
