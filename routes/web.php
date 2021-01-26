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

//rotta generata con l'installazione di laravel/ui che gestisce le logiche di registrazione e login
Auth::routes();

//(es. http://localhost:8000/admin) questa rotta verrà puntata da app/Providers/RouteServiceProvider.php non appena verrà effettuato il login
//middleware('auth')=controllo di autenticazione(verifica che l'utente sia loggato per poter accedere alla seguente rotta)
//namespace('Admin')=cartella in cui si trova la rotta
//prefix('admin')=prefisso da aggiungere nel link(http://localhost:8000/admin)
//name('admin.')= inizio del nome delle rotte (es. admin.index)
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function(){

    Route::get('/', 'HomeController@index')->name('index');
    //sarà collegata con in controller HomeController presente nella cartella Admin(Controllers/Admin/HomeController.php) , dove vado a specificare di eseguire la public function index()
});
