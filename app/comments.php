<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    //
    public function User()
    {
        # code...
        return $this->belongsTo('app\User', 'User_id');
    }

    public function spots()
    {
        # code...
        return $this->belongsTo('app\spots', 'spot_id');
    }

    public function shops()
    {
        # code...
        return $this->belongsTo('app\shops', 'shop_id');
    }
}
