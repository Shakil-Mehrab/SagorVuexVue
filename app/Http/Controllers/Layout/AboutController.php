<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Membership;
use App\Model\Slide;
class AboutController extends Controller
{
  
    public function faq()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.about.faq",compact('products'));
    }
    public function sitemap()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.about.sitemap",compact('products'));
    }
    public function contact()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.about.contact",compact('products'));
    }
    public function banner()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.about.banner",compact('products'));
    }
   
    public function about()
    {
        $members=Membership::orderBy('created_at','desc')->get();
        $slides=Slide::orderBy('created_at','desc')->where('name','about')->get();
        return view("layout.pages.about.about",compact('members','slides'));
    }
    public function helpline()
    {
        $members=Membership::orderBy('created_at','desc')->get();
        $slides=Slide::orderBy('created_at','desc')->where('name','helpline')->get();
        return view("layout.pages.about.helpline",compact('members','slides'));
    }
}    
