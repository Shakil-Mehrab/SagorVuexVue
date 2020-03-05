<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Admin;

class Color extends Model
{
    public function admin(){
    return $this->belongsTo(Admin::class);
  }
}
