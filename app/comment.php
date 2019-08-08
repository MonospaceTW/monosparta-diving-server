<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // data insert blacklist
    protected $guarded = [];

    // define relationship
    public function shops()
    {
        return $this->belongsToMany('App\Shop', 'shop_comments', 'comment_id', 'shop_id')->withTimestamps();
    }

    public function spots()
    {
        return $this->belongsToMany('App\Spot', 'spot_comments', 'comment_id', 'spot_id')->withTimestamps();
    }

    public function Users()
    {
        return $this->belongsTo('App\User');
    }
}
