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
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/registroPropiedad', function(){
    return view('propiedad.add');
});

Route::post('propiedad/create', [
    'uses' => 'PropiedadesController@postCreate'
]);

Route::get('/asignarArrendatario', function(){
    return view('propiedad.addArrendatario');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
