<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function Comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
