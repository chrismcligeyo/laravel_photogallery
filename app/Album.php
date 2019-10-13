<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //

    protected $fillable = [
      'name',
        'description',
        'cover_image',

    ];

    //an album has many photos

    public function photos() {
     return $this->hasMany('App\Photo');
    }
}
