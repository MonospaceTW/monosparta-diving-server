<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // data insert blacklist
    protected $guarded = [];

    // define relationship
    public function commentable()
    {
        return $this->morphTo();
    }

    public function Users()
    {
        return $this->belongsTo('App\User');
    }
}
