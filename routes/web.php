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
        //'middleware' => 'permission:propiedades.editar',
        'uses' => 'VentasController@getVender'
    ])->name('propiedades.vender');

    Route::get('/ventaMultiple', function(){
    	return view('venta.ventaMultiple');
    })->name('venta.ventaMultiple')->middleware('permission:propiedades.editar');

    //ruta para añadir arrendatario a la propiedad
    Route::post('propiedad/vender/{id}', [
        'uses' => 'VentasController@postVender'
    ]);

    // Get detalles propiedad
    Route::get('propiedad/detalles/{id}', [
        'middleware' => 'permission:propiedades.vender',
        'uses' => 'PropiedadesController@getDetallesPropiedad'
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
    
    Route::get('/verClientes', [
        'uses' => 'UsersController@getClientes',
        'middleware' => 'permission:verUsuarios'
    ])->name('verClientes'); 

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

    // Get detalles usuarios
    Route::get('usuario/detalles/{id}', [
        'uses' => 'UsersController@getDetallesUsuario',
        'middleware' => 'permission:verUsuarios'
    ]);
    //ruta para editar los roles de los usuarios
    Route::get('usuario/editRol/{id}', [
        'middleware' => 'permission:usuarios.edit',
        'uses' => 'UsersController@getEditRol'
    ]);

    //ruta para recibir los datos de los roles editados
    Route::put('usuario/editRol/{id}', [
        'middleware' => 'permission:usuarios.edit',        
        'uses' => 'UsersController@putEditRol'
    ]);

    //ruta para el registro de usuarios con diferente rol
    Route::get('/registroUsuario', function () {
        return view('auth.registroUsuarioRol');
    })->name('registroUsuario');

    //ruta para el registro de usuarios con diferente rol
    Route::post('/registroUsuario', [
        'uses' => 'UsersController@postRegistroUsuarioRol',
        'middleware' => 'permission:usuarios.edit'
    ]);


    /*
    |
    |RUTAS PERSONALIZADAS PARA LAS VENTAS
    |
    */ 

    //ruta para generar pdf
    Route::get('ventas/pdf/{id}', [
        'uses' => 'VentasController@pdf',
        'middleware' => 'permission:venta.pdf'
    ])->name('products.pdf'); 

     //ruta para ver las ventas
    Route::get('/verVentas', [
        'middleware' => 'permission:verVentas',
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
        'middleware' => 'permission:verVentas',     
        'uses' => 'VentasController@getEditarVenta'
    ]);

    Route::put('ventas/editar/{id}', [
        'middleware' => 'permission:verVentas',     
        'uses' => 'VentasController@postEditarVenta'
    ]);

    
    /*
    |
    |RUTAS PERSONALIZADAS PARA CALENDARIO
    |
    */ 

    Route::get('agenda', 
    'AgendaController@index'
    )->name('agenda.index')->middleware('permission:verVentas');

    Route::post('agenda',   
    'AgendaController@addEvent'
    )->name('agenda.add')->middleware('permission:verVentas');

    Route::get('agenda/getdatatable', 
    'AgendaController@getDataTableAgenda'
    )->name('agenda/getdatatable')->middleware('permission:verVentas');

    Route::get('/verAgenda', [
        'uses' => 'AgendaController@getAgenda'
    ])->name('verAgenda')->middleware('permission:verVentas');


    /*
    |
    |RUTAS PERSONALIZADAS PARA REPORTES
    |
    */ 

    Route::get('reporteVentas', 
    'ReportesController@reporteVentas'
    )->name('reporteVentas')->middleware('permission:verVentas');

    Route::get('reporteVentasTorre1', 
    'ReportesController@reporteVentasTorre1'
    )->name('reporteVentasTorre1')->middleware('permission:verVentas');

    Route::get('reporteVentasTorre2', 
    'ReportesController@reporteVentasTorre2'
    )->name('reporteVentasTorre2')->middleware('permission:verVentas');

    Route::get('reporteDisponibles', 
    'ReportesController@disponibles'
    )->name('reporteDisponibles')->middleware('permission:verVentas');
    
    Route::get('reporteAnuladas', 
    'ReportesController@reporteVentasAnuladas'
    )->name('reporteAnuladas')->middleware('permission:verVentas');
    
    Route::get('reporteCitasHoy', 
    'ReportesController@reporteCitasHoy'
    )->name('reporteCitasHoy')->middleware('permission:verVentas');  

    Route::get('reporteCitasMes', 
    'ReportesController@reporteCitasMes'
    )->name('reporteCitasMes')->middleware('permission:verVentas');  
    
    Route::get('reporteFiducia', 
    'ReportesController@reporteVentaFiducia'
    )->name('reporteFiducia')->middleware('permission:verVentas');  
    
    Route::get('reporteEncuesta', 
    'ReportesController@reporteEncuesta'
    )->name('reporteEncuesta')->middleware('permission:verVentas');  
    
    
     /*
    |
    |RUTAS PERSONALIZADAS PARA DOCUMENTOS
    |
    */ 
    Route::get('documentos/check/{id}', 
    'DocumentosController@getCheckDocumentos'
    )->name('documentos/check/{id}')->middleware('permission:verVentas');

    Route::put('documentos/registrar/{id}', 
    'DocumentosController@putRegistrarDocumentos'
    )->name('documentos/registrar/{id}')->middleware('permission:verVentas');
    
    Route::get('documentos/getEliminar/{idVenta}', 
    'DocumentosController@getEliminarDocumentos'
    )->name('documentos/getEliminar')->middleware('permission:propiedades.editar');

    Route::delete('documentos/eliminar', 
    'DocumentosController@eliminarDocumentos'
    )->name('documentos/eliminar')->middleware('permission:propiedades.editar');


     /*
    |
    |RUTAS PERSONALIZADAS PARA MODULO DE PRESUPUESTO
    |
    */     
    Route::get('registroClientePresu', function () {
        return view('auth.registroUsuarioPresu');
    })->name('registroClientePresu');

    Route::post('registroClientePresu', [
        'middleware' => 'permission:usuarios.register',
        'uses' => 'UsersController@registroUsuarioPresupuesto',
    ]);

    Route::get('registroPresupuesto', [
        'uses' => 'PresupuestosController@getGenerarPresupuesto',
    ])->name('registroPresupuesto');

    Route::post('registroPresupuesto', [
        'uses' => 'PresupuestosController@postGenerarPresupuesto',
        'middleware' => 'permission:verPropiedades'
    ]);

     /*
    |
    |RUTAS PERSONALIZADAS PARA MODULO DE CARTERA
    |
    */

    //ruta para cerrar la venta
    Route::get('ventas/cerrar/{id}', [
        'middleware' => 'permission:verVentas',     
        'uses' => 'VentasController@getCerrarVenta'
    ]);

    //ruta para cerrar la venta
    Route::post('ventas/cerrar/{id}', [
        'middleware' => 'permission:verVentas',     
        'uses' => 'CarterasController@postCerrarVenta'
    ]);
    
    //ruta para consultar la cartera
    Route::get('consultarCartera',[
        'middleware' => 'permission:verVentas',
        'uses' => 'CarterasController@consultarGet'
    ])->name('consultarCartera');

    //dataTable cartera
    Route::get('carteras/getdatatable', 
    'CarterasController@getDataTableCartera'
    )->name('carteras/getdatatable')->middleware('auth');

    //ruta para administrar pagos
    Route::get('cartera/administrarPagos/{id_venta}',[
        'middleware' => 'permission:verVentas',
        'uses' => 'CarterasController@getAdministrarPagos'
    ]);
});


/*
|
|RUTAS GENERADAS POR AUTH USUARIOS
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('auth.login');
});

/*
|
|RUTAS GENERADAS PARA EDITAR ROLES DE USUARIOS USUARIOS
|
*/



//Para AJAX

Route::get('usuarios/selectAjax/{campo}/{caracteres}', 
'UsersController@selectAjax')->middleware('auth');


// Get Data para datatable tanto users como propiedades
Route::get('usuarios/getdatatable', 
'UsersController@getDataTableUsuarios'
)->name('usuarios/getdatatable')->middleware('auth');

Route::get('clientes/getdatatable', 
'UsersController@getDataTableClientes'
)->name('clientes/getdatatable')->middleware('auth');

Route::get('propiedades/getdatatable', 
'PropiedadesController@getDataTablePropiedades'
)->name('propiedades/getdatatable')->middleware('auth');

Route::get('proyectos/getdatatable', 
'ProyectosController@getDataTableProyectos'
)->name('proyectos/getdatatable')->middleware('auth');

Route::get('ventas/getdatatable', 
'VentasController@getDataTableVentas'
)->name('ventas/getdatatable')->middleware('auth');