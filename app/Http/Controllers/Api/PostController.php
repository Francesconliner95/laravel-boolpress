<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        //prendo la mia tabella posts
        $posts = Post::all();

        //e la passo come api sotto forma di file json
        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }
}
