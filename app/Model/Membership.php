<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
   public function user(){
		return $this->belongsTo('App\User');
	}
	public function country(){
		return $this->belongsTo('App\Model\Country');
	}
	public function city(){
		return $this->belongsTo('App\Model\City');
	}
	public function district(){
		return $this->belongsTo('App\Model\District');
	}
	public function membership_extra_image(){
		return $this->hasMany('App\Model\Membership_extra_image')->latest()->limit(2);
	}
	public function membership_extra_image2nd(){
		return $this->hasMany('App\Model\Membership_extra_image')->latest()->skip(2)->limit(2);
	}
	public function category(){
		return $this->belongsTo('App\Model\Category');
	}
}
