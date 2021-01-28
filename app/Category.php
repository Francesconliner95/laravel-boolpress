<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //per collegare le nostre tabelle tra loro dobbiamo agire anche nei rispettivi Model, quindi vado a creare una funzione posts(al plurale perchè un categoria potrà essere utilizzata in più post)
    public function posts(){
        //hasMany('App\Post') , significa che Category potrà essere utilizzato in più post
        return $this->hasMany('App\Post');
    }
}
