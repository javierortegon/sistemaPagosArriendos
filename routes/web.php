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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
