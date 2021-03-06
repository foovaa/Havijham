<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Post;

class Like extends Model
{

    // table name
    protected $table = 'likes';
    // primary key
    public $primaryKey = 'id';
    // timeestamp
    public $timestamps = true;
    

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Post');
    }
}
