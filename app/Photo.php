<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
      'album_id' , 'photo', 'title', 'size', 'description'
    ];

    public function album (){
        return $this->belongsTo('App\Album');
    }
}
