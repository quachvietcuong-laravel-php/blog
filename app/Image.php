<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $table = 'tbl_image';

    public function posts(){
    	return $this->belongsTo('App\Posts' , 'posts_id' , 'id');
    }
}
