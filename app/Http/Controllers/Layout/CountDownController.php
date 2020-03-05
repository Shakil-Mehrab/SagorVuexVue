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

class CountDownController extends Controller
{
    public function commingsoon()
    {
      return view("comming-soon");
    }
}