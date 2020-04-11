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

Route::get('/', 'EncuestaController@index')->name('index');
Route::get('/home', 'EncuestaController@index')->name('home');
Route::get('/encuestas', 'EncuestaController@index')->name('encuestas.index');
Route::get('/encuestas/{id_encuesta}', 'EncuestaController@show')->name('encuestas.show');
