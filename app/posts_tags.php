<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posts_tags extends Model
{


    protected $primaryKey = 'id';
    public $table = 'posts_tags';
    public $timestamps = true; 

    public function tag() {
        return $this->belongsTo('App\Tag');
    }


    public function post() {
        return $this->belongsTo('App\Post');
    }

}
