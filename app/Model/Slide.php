<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function searchableAs()
    {
        return 'products'; 
    }
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function ownedByUser(User $user){
       return $this->user->id===$user->id;
    }
	public function category(){
		return $this->belongsTo(Category::class);
	}
	public function reviews(){
		return $this->hasMany(Review::class);
	}
	public function getStarRating(){
		$count=$this->reviews()->count('rating');
		if(empty($count)){
			return 0;
		}
		$starCountSum=$this->reviews()->sum('rating');
		$average=$starCountSum/$count;
		return $average;
	}
	public function viewedUsers(){
       return $this->belongsToMany(User::class ,'user_product_views')->withTimestamps()->withPivot(['count']);
    } 
    public function views(){
       return $this->viewedUsers()->sum('count');
       
    }   
}
