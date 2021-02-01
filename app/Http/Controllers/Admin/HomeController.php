<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
        //mi apre la view views/admin/home
    }

    public function profile()
    {
        return view('admin.profile');
        //mi apre la view views/admin/profile
    }

    public function generateToken()
    {
        //genero il token
        $api_token = Str::random(80);

        //prendo la tabella user
        $user = Auth::user();

        //e assegno il token
        $user->api_token = $api_token;

        $user->save();

        //ricarica la pagina e visualizzo il profilo aggionrato
        return redirect()->route('admin.profile');
    }
}
