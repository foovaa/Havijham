<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts() {
        return $ths->belongsToMany('App\Post');
    }

    public function pts() {
        return $this->hasMany('App\posts_tags');
    }
}
