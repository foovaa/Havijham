<?php

namespace App;


use App\User;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['content'];



    // table
    protected $table = 'comments';
    // primary key
    public $primaryKey = 'id';
    // timestamps
    public $timestamps = true;

    public function creator() {
        return $this->belongsTo('App\User');
    }


    public function post() {
        return $this->belongsTo('App\Post');
    }
}
