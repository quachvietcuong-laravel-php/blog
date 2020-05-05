<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'tbl_category';

    public function posts(){
    	return $this->hasMany('App\Posts' , 'category_id' , 'id');
    }
}
