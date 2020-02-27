<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = ['name']; 

    /* Set accessor for 'name' column */

    public function getNameAttribute($val){
        return \ucfirst($val);
    }

}
