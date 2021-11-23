<?php

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

use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/adicionar', 'SeriesController@create')->name('form_criar_serie')->middleware('autenticador');
Route::post('/series/adicionar', 'SeriesController@store')->name('criar_serie')->middleware('autenticador');
Route::post('/series/{id}/edit', 'SeriesController@edit')->name('editar_serie')->middleware('autenticador');
Route::delete('/series/{id}', 'SeriesController@destroy')->name('remover_serie')->middleware('autenticador');
Route::get('/series/{id}/temporadas', 'TemporadasController@index')->name('listar_temporadas');

Route::get('/temporada/{temporada}/episodios', 'EpisodiosController@index')->name('listar_episodios');
Route::post('/temporada/{temporada}/episodios/assistir', 'EpisodiosController@edit')->name('assistir_episodios')->middleware('autenticador');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')->name('entrar');
Route::post('/entrar', 'EntrarController@entrar')->name('entrar');

Route::get('/registrar', 'RegistroController@create')->name('form_criar_usuario');
Route::post('/registrar', 'RegistroController@store')->name('criar_usuario');

Route::get('/sair', function (){
    Auth::logout();
    return redirect()->route('entrar');
});
