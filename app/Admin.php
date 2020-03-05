<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use App\Model\Like;
use App\Model\Comment;
use App\Model\Reply;
use App\Model\Color;
use App\Model\Product;

class Admin extends Authenticatable
{
    
    use Notifiable;
    protected $guard = "admin";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','job_title',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
     public function products()
    {   
     return $this->hasMany(Product::class);
    }  
    public function categories(){
        return $this->hasMany('App\Model\Category');
    }
    public function news()
    {   
     return $this->hasMany('App\Model\News');
    }
    public function likes()
    {   
     return $this->hasMany(Like::class);
    }
    public function comments()
    {   
     return $this->hasMany(Comment::class);
    }
    public function replies()
    {   
     return $this->hasMany(Reply::class);
    }  
    public function color()
    {   
     return $this->hasMany(Color::class);
    }  
    
}



