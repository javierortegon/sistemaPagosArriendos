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

/*
|
|RUTAS PERSONALIZADAS PARA LOS USUARIOS
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// ruta de usuarios
Route::get('/register', function () {
    return view('auth.register');
});

//ruta para consultar los usuarios
Route::get('/verUsuarios', [
    'uses' => 'UsersController@getUsuarios',
    'middleware' => 'auth'
])->name('verUsuarios'); 

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

/*
|
|RUTAS PERSONALIZADAS PARA LOS PROYECTOS
|
*/

// ruta para acceder al formulario de registrar Proyecto
Route::get('/registroProyecto', function () {
    return view('proyecto.add');
})->name('registroProyecto')->middleware('auth');

// ruta para registrar proyecto
Route::post('/registroProyecto', [
    'middleware' => 'auth',
    'uses' => 'ProyectosController@postCrearProyecto',
])->name('registroProyecto');

// ruta para abrir formulario editar un proyecto
Route::get('proyecto/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'ProyectosController@getEditProyecto',
]); 

// ruta para editar un proyecto
Route::put('proyecto/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'ProyectosController@putEditProyecto',
]);

// ruta para consultar los proyectos
Route::get('/proyectos', [
    'middleware' => 'auth',
    'uses' => 'ProyectosController@getProyectos',
])->name('proyectos');

Route::get('proyecto/detalle/{id}', [
    'middleware' => 'auth',
    'uses' => 'ProyectosController@detalleProyecto'
]);

/*
|
|RUTAS PERSONALIZADAS PARA LOS TIPOS DE PROPIEDADES
|
*/

// ruta para listar los tipos de propiedad de un proyecto
Route::get('tiposPropiedad/{id}', [
    'middleware' => 'auth',
    'uses' => 'TiposPropiedadController@tiposPropiedad',
]);

// ruta para registrar los tipos de propiedad de un proyecto
Route::post('registroTipoPropiedad/{id}', [
    'middleware' => 'auth',
    'uses' => 'TiposPropiedadController@postCreate',
]);

//ruta para editar un tipo de propiedad
Route::get('tipoPropiedad/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'TiposPropiedadController@getEditTipoPropiedad',
]);

//ruta para editar un tipo de propiedad
Route::put('tipoPropiedad/edit/{id}', [
    'middleware' => 'auth',
    'uses' => 'TiposPropiedadController@putEditTipoPropiedad',
]);

//ruta para eliminar un tipo de propiedad
Route::delete('tipoPropiedad/delete/{id}', [
    'middleware' => 'auth',
    'uses' => 'TiposPropiedadController@deleteTipo'
]);

/*
|
|RUTAS PERSONALIZADAS PARA LAS PROPIEDADES
|
*/

// ruta para acceder al formulario de registrar propiedad
Route::get('/registroPropiedad', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@getRegister',
])->name('registroPropiedad');

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

//ruta para añadir arrendatario a la propiedad
Route::get('propiedad/vender/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@getVender'
]);

//ruta para añadir arrendatario a la propiedad
Route::post('propiedad/vender/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@postVender'
]);

/*
|
|RUTAS PERSONALIZADAS PARA LOS ARRENDATARIOS
|
*/

//ruta para añadir arrendatario a la propiedad
Route::get('propiedad/addArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'ArrendatariosController@getAddArrendatario'
]);

//ruta para guardar arrendatario a la propiedad
Route::put('propiedad/addArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'ArrendatariosController@putAddArrendatario'
]);

//ruta para editar los datos del arrendatario
Route::get('propiedad/editArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'ArrendatariosController@getEdit'
]);

//ruta para guarda los datos editados del arrendatario
Route::put('propiedad/editArrendatario/{id}', [
    'middleware' => 'auth',
    'uses' => 'ArrendatariosController@putEdit'
]);

//rutas para importar csv
Route::get('importUsers',function(){
	return view('importCsv.chargeCsv', array('origen' => 'usuarios'));
})->name('importUsers')->middleware('auth');

Route::get('importPropiedades',function(){
	return view('importCsv.chargeCsv', array('origen' => 'propiedades'));
})->name('importPropiedades')->middleware('auth');

Route::post('importCsvUsers', 'ImportCsvController@importUsers')->middleware('auth');

Route::post('chooseColumnsCsv', 'ImportCsvController@chooseColumns')->middleware('auth');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Para AJAX

Route::get('usuarios/selectAjax/{campo}/{caracteres}', 'UsersController@selectAjax')->middleware('auth');


// Get Data
Route::get('propiedades/getdatatable', 'PropiedadesController@getDataTablePropiedades')->name('propiedades/getdatatable');