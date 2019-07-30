<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // data insert blacklist
    protected $guarded = [];

    // define relationship
    public function User()
    {
        return $this->belongsTo(User::class)->select(array('id', 'userName', 'email'));
    }

    public function Spots()
    {
        return $this->belongsToMany(Spot::class);
    }

    public function Shops()
    {
        return $this->belongsTo(Shop::class);
    }
}
