<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table = 'tbl_like';

    public function posts(){
    	return $this->belongsTo('App\Posts' , 'posts_id' , 'id');
    }

    public function customers(){
    	return $this->belongsTo('App\Customers' , 'customers_id' , 'id');
    }
}
