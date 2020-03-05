<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Model\Review;
use App\Model\Product;
use App\Model\Category;
use App\Model\Rating;
use App\User;

class Product extends Model
{
    use Notifiable;
	// use Searchable;
    
    public function searchableAs()
    {
        return 'product'; 
    }
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function product(){
		return $this->belongsTo('App\User');
	}
	//this class is only for counting users total products total views
	public function saling_products(){
		return $this->hasMany('App\Model\Order_product');
	}
	public function product_video(){
		return $this->hasOne('App\Model\Product_video');
	}
	public function medias(){
		return $this->hasMany('App\Model\Media');
	}
	public function ownedByUser(User $user){
       return $this->user->id===$user->id;
    }
	public function category(){
		return $this->belongsTo(Category::class);
	}
	public function reviews(){
		return $this->hasMany(Review::class)->latest();
	}
	public function chats(){
		return $this->hasMany("App\Model\Chat");
	}
	public function ratings(){
		return $this->hasMany(Rating::class);
	}
	public function getStarRating(){
		$count=$this->reviews()->count('rating');
		if(empty($count)){
			return 0;
		}
		$starCountSum=$this->reviews()->sum('rating');
		$average=floor($starCountSum/$count);
		return $average;
	}
	 // public function toSearchableArray()
  //   {
  //       $listins = $this->toArray();
  //       $listins['created_at_human']=$this->created_at->diffForHumans();
  //       $listins['user']=$this->user;
  //       $listins['category']=$this->category;
  //       $listins['name']=$this->name;
  //       return $listins;
  //   }
	public function viewedUsers(){
       return $this->belongsToMany(User::class ,'user_product_views')->withTimestamps()->withPivot(['count']);
    } 
    public function views(){
       return $this->viewedUsers()->sum('count');
       
    }  

    public function sumProductPrice(){
       return $this->belongsToMany(Product::class ,'order_products')->withTimestamps()->withPivot(['total']);
    } 
    public function totalsale(){
       return $this->sumProductPrice()->sum('total');
       
    }


    public function sumDeliveredProductPrice(){
       return $this->belongsToMany(Product::class ,'order_products')->withTimestamps()->withPivot(['total']);
    } 
    public function totaldeliveredsale(){
       return $this->sumDeliveredProductPrice()->count('total');
       
    }    

}
