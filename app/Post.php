<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



// use App\User;
// at the step working with eloquent
// and making controllers and routing create the post model
class Post extends Model
{
    // table name
    protected $table = 'posts';
    // primary key
    public $primaryKey = 'id';
    // timeestamp
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }


    public function tags() {
        return $this->hasMany('App\Post');
    }
}
