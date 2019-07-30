<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // data insert blacklist
    protected $guarded = [];

    // define relationship
    public function Users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function Spots()
    {
        return $this->belongsToMany(Spot::class)->withTimestamps();
    }

    public function Shops()
    {
        return $this->belongsToMany(Shop::class)->withTimestamps();
    }
}
