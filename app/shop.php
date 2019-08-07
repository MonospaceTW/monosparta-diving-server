<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // define relationship
    public function Comments()
    {
        return $this->belongsToMany('App\Comment')->withTimestamps();
    }
}
