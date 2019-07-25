<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    // data insert blacklist
    protected $guarded = [];

    // define relationship
    public function User()
    {
        return $this->belongsTo(User::class)->select(array('id', 'userName', 'email'));
    }

    public function spot()
    {
        return $this->belongsTo(spot::class);
    }

    public function shops()
    {
        return $this->belongsTo(shop::class);
    }
}
