<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = ['path'];

    public function post(){
        return $this->hasOne('App\Post');
    }

    public function getPathAttribute($val){
        return "/images/posts/" . $val;
    }
}
