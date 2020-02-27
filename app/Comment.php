<?php

namespace App;
use App\Post;
use App\User;
use App\Reply;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'is_active', 'email', 'body'
    ];

    /* Relations for Comment model*/

    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

}
