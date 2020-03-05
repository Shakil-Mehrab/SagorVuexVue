<?php

namespace App\Http\Controllers\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\RepliedToProduct;
use App\Http\Requests\StoreReviewRequest;
use App\Jobs\UserProductRating;
use App\Model\Review;
use App\Model\Reply;
use App\Model\Rating;
use App\Model\Product;
use App\Model\Chat;


class ReviewController extends Controller
{
    public function index()
    {
        $reviews=Review::all();
        return view('layouts.pages.reviews.index',compact('reviews'));
    }
    public function ProductReview(StoreReviewRequest $request,$id)
    {
        $product=Product::find($id);
        $review=new Review;
        $review->body=$request['body'];
        $review->product_id=$id;    
        $review->rating=$request['star'];
        if($request->user()){
           dispatch(new UserProductRating($request->user(),$product,$request['star']));}
        $request->user()->reviews()->save($review);
        $product->user->notify(new RepliedToProduct($product)); 
        return back()->withSuccess('Thank You for Your Review');
    }
    public function ChatReply(Request $request,$id)
    {
        $review=Review::find($id);
        $reply=new Reply;
        $reply->body=$request['body'];
        $reply->chat_id=$id;    
        $request->user()->chats()->save($reply);
        // $product->user->notify(new RepliedToProduct($product)); 
        return back()->withSuccess('Thank You for Your Reply');
    }
    public function Chating(Request $request,$id)
    {
        $product=Product::where('id',$id)->first();
        $review=new Chat;
        $review->body=$request['body'];
        $review->product_id=$id;    
        $request->user()->chats()->save($review);
        // $product->user->notify(new RepliedToProduct($product)); 
        return back()->withSuccess('Thank You for Your Review');
    }
}
