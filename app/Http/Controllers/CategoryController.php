<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //al click mi collego alla funzione show e mi passo lo slug
    public function show($slug){
        //verifico nella se nella tabella categories è presente una categoria con lo stesso slug selezionato, se si prendo la prima categoria e me la passo in pagina con $data, altrimenti 404
        $category= Category::where('slug' , $slug)->first();
        if(!$category){
            abort(404);
        }
        $data = [
            'category' => $category
        ];
        return view('guest.categories.show', $data);
    }
}
