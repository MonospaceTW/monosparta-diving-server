<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spot extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level',
        'location',
        'name',
        'description',
        'longitude',
        'latitude',
        'img1',
        'img2',
        'img3',
        'img4',
        'img5',
    ];

    public function comments()
    {
        return $this->hasMany(comment::class)->select(array('spot_id','comment','rating'));
    }
}
