<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     public function city(){
		return $this->belongsTo('App\Model\City');
	}
}
