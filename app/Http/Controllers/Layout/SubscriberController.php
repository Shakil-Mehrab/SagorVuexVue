<?php

namespace App\Http\Controllers\Layout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Subscriber;
use App\Http\Requests\StoreSubscriberFormRequest;

class SubscriberController extends Controller
{
    public function subscribe(StoreSubscriberFormRequest $request)
    {
        $product=new Subscriber();
        $product->email=$request['email'];
        $product->save();
        return redirect()->back()->withSuccess('Thank for Subscribing us!');          
    }
}
