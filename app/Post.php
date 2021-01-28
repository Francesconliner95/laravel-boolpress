<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //da specificare solamente quando il nome del Model 'Post' non corrisponde al singolare della tabella nel nostro database  'posts'
    //protected $table = 'posts';

    //con questo comando andiamo a specificare solo i parametri che ci interessa passare al database, quindi li scriviamo tutti tranne il token @csrf
    protected $fillable = ['title', 'description', 'slug', 'category_id'];

    //per collegare le nostre tabelle tra loro dobbiamo agire anche nei rispettivi Model, quindi vado a creare una funzione category(al singolare perchè una categoria potrà essere utilizzata in più post)
    public function category(){
        //belongsTo('App\Category'), significa che Post può utilizzare (appartiene ad) una sola categoria.
        return $this->belongsTo('App\Category');
    }
}
