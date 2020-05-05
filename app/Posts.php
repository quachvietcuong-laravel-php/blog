<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $table = 'tbl_posts';

    public function category(){
    	return $this->belongsTo('App\Category' , 'category_id' , 'id');
    }

    public function user(){
    	return $this->belongsTo('App\User' , 'users_id' , 'id');
    }

    public function image(){
    	return $this->hasMany('App\Image' , 'posts_id' , 'id');
    }

    public function comments(){
        return $this->hasMany('App\Comments' , 'posts_id' , 'id');
    }

    public function like(){
        return $this->hasMany('App\Like' , 'posts_id' , 'id');
    }
}
