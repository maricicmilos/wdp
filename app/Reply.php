<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\User;

class Reply extends Model
{
    protected $fillable = [
        'user_id', 'comment_id', 'is_active', 'email', 'body'
    ];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
