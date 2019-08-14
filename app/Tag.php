<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    // table name
    protected $table = 'tags';
    // primary key
    public $primaryKey = 'id';
    // timeestamp
    public $timestamps = true;

    // protected $fillable = ['tag'];


    public function post() {
        return $this->belongsTo('App\Post');
    }
}
