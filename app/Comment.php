<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Relacion muchos a uno con la publicacion
    public function publication()
    {
        return $this->belongsTo('App\Publication');
    }

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

}
