<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
   public function country(){
		return $this->belongsTo('App\Model\Country');
	}
	public function city(){
        return $this->belongsTo('App\Model\City');
    }
     public function district(){
        return $this->belongsTo('App\Model\District');
    }
    public function area(){
        return $this->belongsTo('App\Model\Area');
    }
}
