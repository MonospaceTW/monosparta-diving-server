<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spots extends Model
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
}
