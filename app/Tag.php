<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        //belongsToMany('App\Post'), significa che Tag può utilizzare (appartiene a) più post.
        return $this->belongsToMany('App\Post');
    }
}
