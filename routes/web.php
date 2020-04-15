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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'EncuestaController@grupoindex')->name('index');
Route::get('/home', 'EncuestaController@grupoindex')->name('home');
Route::get('/encuestas', 'EncuestaController@grupoindex')->name('encuestas');

Route::get('/encuestas/{id}', 'EncuestaController@index')->name('encuestas.index');
Route::get('/encuestas/{id}/{id_encuesta}', 'EncuestaController@show')->name('encuestas.show');
Route::get('/encuestaStore','EncuestaController@store')->name('store.ajax');
Route::post('/guardarfoto', 'EncuestaController@guardarFoto')->name('guardarfoto.ajax');
/* administracion */
Route::get('/administracion','AdminController@index')->name('admin.index');
Route::get('/listaEncuestas','AdminController@listaEncuestas')->name('encuestas.admin');
Route::get('/listaEncuestas/{id}','AdminController@show')->name('encuestas.show.admin');


