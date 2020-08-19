<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{   
    // Relacion uno a muchos con los comentarios
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    public function user() 
    {
        return $this->belongsTo('App\User');
    }

}