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

// ruta de usuarios
Route::get('/register', function () {
    return view('auth.register');
});

// ruta para acceder al formulario de registrar propiedad
Route::get('/registroPropiedad', function(){
    return view('propiedad.add');
});

Route::get('/asignarArrendatario', [
    'uses' => 'PropiedadesController@addArrendatario'
]); 

// ruta de recepcion del formulario, registro propiedad
Route::post('propiedad/create', [
    'uses' => 'PropiedadesController@postCreate'
]);


// ruta de recepcion del formulario, registro propietario
Route::post('propietario/create', [
    'uses' => 'PropiedadesController@postAddArrendatario'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
