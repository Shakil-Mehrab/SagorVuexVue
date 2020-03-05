<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User_product_rating;
use App\Model\User_product_view;
use App\Model\Product_video;
use App\Model\Order_product;
use App\Model\Category;
use App\Model\Product;
use App\Model\Country;
use App\Model\Review;
use App\Model\Slide;
use App\Model\Video;

 
class FrontController extends Controller
{
    public function index(){
        $totalSprcialOffers=Product::where('discount','>','0')->where('status','approved')->get();
        $totalCountSprcialOffers=$totalSprcialOffers->count();
        
        $totalElectronics=Product::where('category_id','3')->where('status','approved')->get();
        $totalCountElectronics=$totalElectronics->count();
        
        $totalFashionJewelrys=Product::where('category_id','2')->where('status','approved')->get();
        $totalCountFashionJewelrys=$totalFashionJewelrys->count();
        
        
        $categories=Category::orderBy('created_at','desc')->limit(10)->get();
        $slides=Slide::orderBy('id','desc')->where('name','home')->limit(8)->get();
        $dealOfDays_products=Order_product::orderBy('id','desc')->get();
        $toprated_products=User_product_rating::orderBy('rating','desc')->get();
        $fourcats=Category::orderBy('created_at','desc')->get();
        $topquality_products=Product::orderBy('id','desc')->where('position','topcollection')->where('status','approved')->get();
        $specialOffers=Product::orderBy('created_at','desc')->where('discount','>','0')->where('status','approved')->limit($totalCountSprcialOffers/2)->get();
        $specialSecondOffers=Product::orderBy('created_at','desc')->where('discount','>','0')->where('status','approved')->skip($totalCountSprcialOffers/2)->limit(ceil($totalCountSprcialOffers/2))->get();
        $popular_products=User_product_view::orderBy('count','desc')->get(); 
        $products=Product::orderBy('created_at','desc')->where('status','approved')->where('discount',0)->get();//recent
		$electronics=Product::orderBy('created_at','desc')->where('category_id','3')->where('status','approved')->limit($totalCountElectronics/2)->get();
		$secondElectronics=Product::orderBy('created_at','desc')->where('category_id','3')->where('status','approved')->skip($totalCountElectronics/2)->limit(ceil($totalCountElectronics/2))->get();
		$fashionJewelrys=Product::orderBy('created_at','desc')->where('category_id','2')->where('status','approved')->limit($totalCountFashionJewelrys/2)->get();
		$secondFashionJewelrys=Product::orderBy('created_at','desc')->where('category_id','2')->where('status','approved')->skip($totalCountFashionJewelrys/2)->limit(ceil($totalCountFashionJewelrys/2))->get();
        // $videos=Video::orderBy('id','desc')->limit(4)->get();
        // $product_videos=Product_video::orderBy('id','desc')->paginate(8);
        $countries=Country::orderBy('id','desc')->where('pavilion','1')->limit('7')->get();
		return view("welcome",compact('categories','slides','dealOfDays_products','toprated_products','toprated_products','fourcats','topquality_products','specialOffers','specialSecondOffers','popular_products','products','electronics','secondElectronics','fashionJewelrys','secondFashionJewelrys','countries'));
	}


    public function popular()
    {
        $pop_products=User_product_view::orderBY('count','desc')->get();
        $latest_products=Product::orderBY('id','desc')->where('status','approved')->limit(5)->get();
        $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get();
        return view("layout.pages.products.popular",compact('pop_products','latest_products','popular_products'));
    }
    public function recent()
    {
        $products=Product::orderBY('id','desc')->where('status','approved')->get();
        $latest_products=Product::orderBY('id','desc')->where('status','approved')->limit(5)->get();
        $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get();
        return view("layout.pages.products.recent",compact('products','latest_products','popular_products'));
    }
    public function special()
    {
        $products=Product::orderBy('created_at','desc')->where('discount','>','0')->where('status','approved')->get();
        $latest_products=Product::orderBY('id','desc')->where('status','approved')->limit(5)->get();
        $popular_products=User_product_view::orderBY('count','desc')->limit(5)->get();
        return view("layout.pages.products.specialOffer",compact('products','latest_products','popular_products'));
    }
    public function temporary()
    {
        $videos=Video::orderBy('id','desc')->limit(1)->get();
        return view("temporary",compact('videos'));

    }
    public function commingsoon()
    {
        return view("comming-soon");
    }
}


