<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Slide;
use App\Model\Product;
use App\Model\User_product_view;
use App\Model\Review;
use App\Model\Category;
use App\Model\Video;
use App\Model\Product_video;
use App\Model\User_product_rating;
use App\Model\Order_product;

class PavilionController extends Controller
{
    public function index()
    {
        $slides=Slide::orderBy('id','desc')->where('name','pavilion')->get();
        return view("layout.pages.pavilion.index",compact('slides'));
    }
    public function show($id)
    {
        $slides=Slide::orderBY('id','desc')->get();
		$products=Product::orderBy('created_at','desc');
		$toprated_products=User_product_rating::orderBy('rating','desc')->get();
		$dealOfDays_products=Order_product::orderBy('id','desc')->get();
		$topquality_products=Product::orderBy('id','desc')->where('quality','low')->get();


        $popular_products=User_product_view::orderBY('count','desc')->limit(10)->get(); 
		$categories=Category::orderBy('created_at','desc')->paginate(10);
		$electronics=Category::where('name','Electronics')->first();
		$fashion_jewelry=Category::where('name','Fashion&Jewelry')->first();


        $videos=Video::orderBy('id','desc')->limit(4)->get();
        $product_videos=Product_video::orderBy('id','desc')->paginate(8);

		return view("layout.pages.pavilion.show",compact('fashion_jewelry','electronics','topquality_products','toprated_products','dealOfDays_products','products','slides','popular_products','rating_products','categories','videos','product_videos'));
	}

}
