<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//(es. http://localhost:8000/) All'avvio parto con la seguente rotta, collegata con in controller HomeController (Controllers/HomeController.php) , dove vado a specificare di eseguire la public function index()
Route::get('/', 'HomeController@index')->name('index');

Route::get('/posts', 'PostController@index')->name('guest.posts.index');

Route::get('/posts/{param}', 'PostController@show')->name('guest.posts.show');

Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');

//rotta generata con l'installazione di laravel/ui che gestisce le logiche di registrazione e login
Auth::routes();

// Auth::routes(['register' => false]);
//Nel caso volessi vietare la registrazione agli utenti, chiudo la rotta con il seguente comando ['register' => false]

//(es. http://localhost:8000/admin) questa rotta verrà puntata da app/Providers/RouteServiceProvider.php non appena verrà effettuato il login
//middleware('auth')=controllo di autenticazione(verifica che l'utente sia loggato per poter accedere alla seguente rotta)
//namespace('Admin')=cartella in cui si trova la rotta
//prefix('admin')=prefisso da aggiungere nel link(http://localhost:8000/admin)
//name('admin.')= inizio del nome delle rotte (es. admin.index)
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){

    Route::get('/', 'HomeController@index')->name('index');
    //sarà collegata con in controller HomeController presente nella cartella Admin(Controllers/Admin/HomeController.php) , dove vado a specificare di eseguire la public function index()
    Route::resource('/posts', 'PostController');

    Route::resource('/tags', 'TagController');

    //rotta per visualizzare il profilo dell'utente loggato
    Route::get('/profile', 'HomeController@profile')->name('profile');

    //rotta per visualizzare il profilo dell'utente loggato
    Route::post('/profile/generate-token', 'HomeController@generateToken')->name('generate_token');
});
