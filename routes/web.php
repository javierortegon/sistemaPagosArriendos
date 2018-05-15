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

Route::middleware(['auth'])->group(function() {

    /*
    |
    |RUTAS PERSONALIZADAS PARA LOS PROYECTOS
    |
    */

    // ruta para acceder al formulario de registrar Proyecto
    Route::get('/registroProyecto', function () {
        return view('proyecto.add');
    })->name('proyecto.registro')->middleware('permission:proyecto.registro');

    // ruta para recibir los datos de registrar proyecto
    Route::post('/registroProyecto', [
        'uses' => 'ProyectosController@postCrearProyecto',
    ])->name('registroProyecto');    

    // ruta para consultar los proyectos
    Route::get('/proyectos', [
        'middleware' => 'permission:proyectos.consultar',
        'uses' => 'ProyectosController@getProyectos',
    ])->name('proyectos.consultar');
    
    // ruta para abrir formulario editar un proyecto
    Route::get('proyecto/edit/{id}', [
        'middleware' => 'permission:proyectos.edit',
        'uses' => 'ProyectosController@getEditProyecto',
    ])->name('proyectos.edit'); 

    // ruta para recibir los datos de editar un proyecto
    Route::put('proyecto/edit/{id}', [
        'uses' => 'ProyectosController@putEditProyecto',
    ]);

    // ruta para ver los detalles del proyecto
    Route::get('proyecto/detalle/{id}', [
        'middleware' => 'permission:proyectos.detalle',
        'uses' => 'ProyectosController@detalleProyecto'
    ])->name('proyectos.detalle');

    /*
    |
    |RUTAS PERSONALIZADAS PARA LOS TIPOS DE PROPIEDADES
    |
    */

    // ruta para listar los tipos de propiedad de un proyecto
    Route::get('tiposPropiedad/{id}', [
        'middleware' => 'permission:tiposPropiedad.consultar',
        'uses' => 'TiposPropiedadController@tiposPropiedad',
    ])->name('tiposPropiedad.consultar');

    // ruta para registrar los tipos de propiedad de un proyecto
    Route::post('registroTipoPropiedad/{id}', [
        'uses' => 'TiposPropiedadController@postCreate',
    ]);

    //ruta para editar un tipo de propiedad
    Route::get('tipoPropiedad/edit/{id}', [
        'middleware' => 'permission:tiposPropiedad.edit',
        'uses' => 'TiposPropiedadController@getEditTipoPropiedad',
    ])->name('tiposPropiedad.edit');

    //ruta para editar un tipo de propiedad
    Route::put('tipoPropiedad/edit/{id}', [
        'uses' => 'TiposPropiedadController@putEditTipoPropiedad',
    ]);

    //ruta para eliminar un tipo de propiedad
    Route::delete('tipoPropiedad/delete/{id}', [
        'uses' => 'TiposPropiedadController@deleteTipo'
    ]);

    /*
    |
    |RUTAS PERSONALIZADAS PARA LAS PROPIEDADES
    |
    */

    //ruta para obtener los tipos del proyecto
    Route::get('proyectoTipos/{id}', [
        'uses' => 'PropiedadesController@getProyectoTipos',
    ]);

    // ruta para acceder al formulario de registrar propiedad
    Route::get('/registroPropiedad', [
        'middleware' => 'permission:registroPropiedad',
        'uses' => 'PropiedadesController@getRegister',
    ])->name('registroPropiedad');

    // ruta de recepcion del formulario, registro propiedad
    Route::post('propiedad/create', [
        'uses' => 'PropiedadesController@postCreate',
    ]);

    //ruta para consultar las propiedades
    Route::get('/verPropiedades', [
        'uses' => 'PropiedadesController@getPropiedades',
        'middleware' => 'permission:verPropiedades'
    ])->name('verPropiedades'); 

    // ruta para cargar el csv de propiedades
    Route::get('importPropiedades',function(){
        return view('importCsv.chargeCsv', array('origen' => 'propiedades'));
    })->name('propiedades.cargar')->middleware('permission:propiedades.cargar');

    Route::post('importCsvUsers', 
    'ImportCsvController@importUsers');

    Route::post('chooseColumnsCsv', 
    'ImportCsvController@chooseColumns');

    //ruta para editar las propiedades
    Route::get('propiedad/edit/{id}', [
        'middleware' => 'permission:propiedades.editar',
        'uses' => 'PropiedadesController@getEdit'
    ])->name('propiedades.editar');

    //ruta para recibir los datos de la propiedad editada
    Route::put('propiedad/edit/{id}', [
        'uses' => 'PropiedadesController@putEdit'
    ]);

    //ruta para añadir arrendatario a la propiedad
    Route::get('propiedad/vender/{id}', [
        'middleware' => 'permission:propiedades.vender',
        'uses' => 'VentasController@getVender'
    ])->name('propiedades.vender');

    //ruta para añadir arrendatario a la propiedad
    Route::post('propiedad/vender/{id}', [
        'uses' => 'VentasController@postVender'
    ]);

    /*
    |
    |RUTAS PERSONALIZADAS PARA LOS USUARIOS
    |
    */ 

    // ruta de usuarios
    Route::get('/register', function () {
        return view('auth.register');
    })->name('usuarios.register');

    //ruta para consultar los usuarios
    Route::get('/verUsuarios', [
        'uses' => 'UsersController@getUsuarios',
        'middleware' => 'permission:verUsuarios'
    ])->name('verUsuarios'); 

    //ruta para editar los usuarios
    Route::get('usuario/edit/{id}', [
        'middleware' => 'permission:usuarios.edit',
        'uses' => 'UsersController@getEdit'
    ])->name('usuarios.edit');

    //ruta para recibir los datos del usuario editado
    Route::put('usuario/edit/{id}', [
        'uses' => 'UsersController@putEdit'
    ]);
    
    //rutas para importar csv de usuarios
    Route::get('importUsers',function(){
    	return view('importCsv.chargeCsv', array('origen' => 'usuarios'));
    })->name('importUsers')->middleware('permission:usuarios.cargar');

    /*
    |
    |RUTAS PERSONALIZADAS PARA LAS VENTAS
    |
    */ 

    Route::get('descargar-pdf', 
        'VentasController@pdf')->name('products.pdf');

});


/*
|
|RUTAS PERSONALIZADAS PARA LOS USUARIOS
|
*/

Route::get('/', function () {
    return view('auth.login');
});

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
|RUTAS PERSONALIZADAS PARA LAS PROPIEDADES
|
*/

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Para AJAX

Route::get('usuarios/selectAjax/{campo}/{caracteres}', 'UsersController@selectAjax')->middleware('auth');


// Get Data para datatable tanto users como propiedades
Route::get('usuarios/getdatatable', 'UsersController@getDataTableUsuarios')->name('usuarios/getdatatable');
Route::get('propiedades/getdatatable', 'PropiedadesController@getDataTablePropiedades')->name('propiedades/getdatatable');
Route::get('proyectos/getdatatable', 'ProyectosController@getDataTableProyectos')->name('proyectos/getdatatable');
Route::get('ventas/getdatatable', 'VentasController@getDataTableVentas')->name('ventas/getdatatable');

// Get detalles propiedad
Route::get('propiedad/detalles/{id}', [
    'middleware' => 'auth',
    'uses' => 'PropiedadesController@getDetallesPropiedad'
]);

// Get detalles usuarios
Route::get('usuario/detalles/{id}', [
    'middleware' => 'auth',
    'uses' => 'UsersController@getDetallesUsuario'
]);

 //ruta para ver las ventas
Route::get('/verVentas', [
    'middleware' => 'permission:propiedades.editar',
    'uses' => 'VentasController@getVentas'
])->name('verVentas');

 //ruta para anular las ventas
Route::get('ventas/anular/{id}', [
    'middleware' => 'permission:propiedades.editar',     
    'uses' => 'VentasController@getAnularVenta'
]);
Route::put('ventas/anular/{id}', [
    'middleware' => 'permission:propiedades.editar',     
    'uses' => 'VentasController@postAnularVenta'
]);

 //ruta para editar las ventas
Route::get('ventas/editar/{id}', [
    'middleware' => 'permission:propiedades.editar',     
    'uses' => 'VentasController@getEditarVenta'
]);
Route::put('ventas/editar/{id}', [
    'middleware' => 'permission:propiedades.editar',     
    'uses' => 'VentasController@postEditarVenta'
]);