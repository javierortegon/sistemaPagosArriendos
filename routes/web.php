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
Route::get('/registroPropiedad', [
    'middleware' => 'auth',
     function () {
        return view('propiedad.add');
}])->name('registroPropiedad');


// ruta de recepcion del formulario, registro propiedad
Route::post('propiedad/create', [
    'uses' => 'PropiedadesController@postCreate',
    'middleware' => 'auth',
]);

// ruta asiganar arrendatario
Route::get('/asignarArrendatario', [
    'uses' => 'PropiedadesController@addArrendatario',
    'middleware' => 'auth'
])->name('asignarArrendatario'); 

// ruta de recepcion del formulario, registro arrendatario
Route::post('arrendatario/create', [
    'uses' => 'PropiedadesController@postAddArrendatario',
    'middleware' => 'auth',
]);

//ruta para consultar las propiedades
Route::get('/verPropiedades', [
    'uses' => 'PropiedadesController@getPropiedades',
    'middleware' => 'auth'
])->name('verPropiedades'); 

//ruta para consultar los usuarios
Route::get('/verUsuarios', [
    'uses' => 'UsersController@getUsuarios',
    'middleware' => 'auth'
])->name('verUsuarios'); 

//ruta para editar las propiedades
Route::get('propiedad/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@getEdit'
]);

//ruta para recibir los datos de la propiedad editada
Route::put('propiedad/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@putEdit'
]);

//ruta para editar los usuarios
Route::get('usuario/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@getEdit'
]);

//ruta para recibir los datos del usuario editado
Route::put('usuario/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@putEdit'
]);

//ruta para editar los roles de los usuarios
Route::get('usuario/editRol/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@getEditRol'
]);

//ruta para recibir los datos de los roles editados
Route::put('usuario/editRol/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@putEditRol'
]);

//ruta para añadir arrendatario a la propiedad
Route::get('propiedad/addArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@getAddArrendatario'
]);


//ruta para guardar arrendatario a la propiedad
Route::put('propiedad/addArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@putAddArrendatario'
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
