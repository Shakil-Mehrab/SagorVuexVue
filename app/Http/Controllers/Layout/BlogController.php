<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;

class BlogController extends Controller
{
    
    public function faq()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.blog.index",compact('products'));
    }
    public function about2()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.blog.index",compact('products'));
    }
    public function about3()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.blog.index",compact('products'));
    }
    public function about4()
    {
        $products=Product::orderBy('created_at','desc')->paginate(8);
        return view("layout.pages.blog.index",compact('products'));
    }
}
