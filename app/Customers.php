<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    protected $table = 'tbl_customers';

    public function comments(){
    	return $this->hasMany('App\Comments' , 'customers_id' , 'id');
    }

    public function like(){
    	return $this->hasMany('App\Like' , 'customers_id' , 'id');
    }
}
