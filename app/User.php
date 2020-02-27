<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;
use App\Comment;
use App\Reply;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'fname', 'lname', 'avatar', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Set User Model Realtionships */

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    /* Set fname & lname column accessories */

    public function getFnameAttribute($val){
        return \ucfirst($val);
    }

    public function getLnameAttribute($val){
        return \ucfirst($val);
    }

    /* Functionality for User model */

    public function countAllComments(){
        $comments = count($this->comments);
        $replies = count($this->replies);
        $userComments = $comments + $replies;
        return $userComments;
    }

    public function countApprovedComments(){
        $appComments = Comment::where('user_id', '=', $this->id)
        ->where('is_active', '=', '1')->get();

        $appReplies = Reply::where('user_id', '=', $this->id)
        ->where('is_active', '=', '1')->get();

        return count($appComments) + count($appReplies);        
    }

    public function countUnapprovedComments(){
        $unAppComments = Comment::where('user_id', '=', $this->id)
        ->where('is_active', '=', '0')->get();

        $unAppReplies = Reply::where('user_id', '=', $this->id)
        ->where('is_active', '=', '0')->get();

        return count($unAppComments) + count($unAppReplies);
    }

    

}
