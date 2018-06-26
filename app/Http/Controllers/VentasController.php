<?php

namespace App\Http\Controllers;

use DB;

use App\Propiedad;
use App\User;
use App\Propietario;
use App\Proyecto;
use App\Arrendatario;
use App\Venta;
use App\TiposPropiedad;
use App\RolesUsers;
use App\NovedadVenta;
use App\DatosComprador;
use App\Agenda;

use Barryvdh\DomPDF\Facade as PDF;

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    public function getVender($id){
        $propiedad = Propiedad::select( 'propiedades.id as id', 
                                        'propiedades.codigo', 
                                        'propiedades.nombre', 
                                        'propiedades.direccion', 
                                        'propiedades.estado', 
                                        'proyectos.nombre as nombreProyec',
                                        'tipos_propiedad.nombre as tipo',
                                        'tipos_propiedad.valor as valor')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->where('propiedades.id', '=', $id)
        ->get();

        $valor = (string) $propiedad[0]->valor;
        $pos = strpos($valor, '.') - 3;
        $valor = substr_replace($valor, ',', $pos, 0);
        $valor = substr_replace($valor, '`', $pos-3, 0);
        $valor = substr_replace($valor, '$ ', 0, 0);

        $consultaVenta = $users = DB::table('ventas')
                        ->where([
                            ['propiedad', "=", $id],
                            ['estado', '=', '1']
                        ])
                        ->count();
        if($consultaVenta != 0){
            Notification::error('La propiedad que seleccionó ya fue vendida');
            return redirect('/verPropiedades');
        } else {
            return view ('propiedad.venta', ['propiedad' => $propiedad, 'valor' => $valor]);
        }

    }
    
    protected function validatorDoc(array $data){
        return Validator::make($data, [
            'documento' => 'required|unique:users|max:255',
        ]);
    }

    public function postVender($id, Request $request){
        $propiedad = Propiedad::select( 'propiedades.id as id', 
                                        'tipos_propiedad.valor as valor')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->where('propiedades.id', '=', $id)
        ->first();
        $origenUsuario = $request->input('usuarioNoE');
        if($origenUsuario == "nuevo"){
            $this->validatorDoc($request->all())->validate();
            $comprador = new User;
            $comprador->name = $request->name;
            $comprador->password = bcrypt($request->documento);
            $comprador->documento = $request->documento;
            $comprador->telefono = $request->telefono;
            $comprador->estado = 1;
            $comprador->save();
            $idComprador = $comprador->id;

            $rolesUsers = new RolesUsers;
            $rolesUsers->user_id = $idComprador;
            $rolesUsers->role_id = 3;
            $rolesUsers->save();
            
            Notification::success('Usuario creado correctamente');
            
        }
        else{
            $idComprador = $request->input('inputUserId');
        }
        
        $consultaVenta = Venta::where([
                            ['propiedad', "=", $id],
                            ['estado', '=', '1']
                        ])
                        ->count();

        if($consultaVenta == 0){
            $venta = new Venta;
            $venta->fecha = date('Y-m-d');
            $venta->valor = $propiedad->valor;
            $venta->metodo_pago = $request->metodoPago;
            $venta->estado = 1;
            $venta->propiedad = $id;
            $venta->comprador = $idComprador;
            $venta->vendedor = Auth::id();
            $venta->save();
    
            //Segundo nivel de verificación (para garantizar que no se crucen ventas).

            $consulta2Venta =   Venta::where([
                                    ['propiedad', "=", $id],
                                    ['estado', '=', '1']
                                ])
                                ->get();

            if($consulta2Venta[0]->id != $venta->id){
                $venta->estado = 0;
                $venta->save();                
                Notification::error('La propiedad que seleccionó ya fue vendida');   
            } else {
                Notification::success('Venta registrada con exito');
            }

        } else { 
            Notification::error('La propiedad que seleccionó ya fue vendida');
        }
        return redirect('/verPropiedades');
    }

    public function getCerrarVenta($id){
        $venta = Venta::select( 'ventas.id as id',
                                'ventas.comprador as comprador',
                                'ventas.comprador2 as comprador2',
                                'propiedades.id as idPropiedad', 
                                'propiedades.codigo', 
                                'propiedades.nombre', 
                                'propiedades.direccion as direccionPropiedad', 
                                'propiedades.estado', 
                                'proyectos.nombre as nombreProyec',
                                'tipos_propiedad.nombre as tipo',
                                'tipos_propiedad.valor as valor',
                                'users.name as name',
                                'users.email as email',
                                'users.telefono as telefono',
                                'users.tipo_documento as tipo_documento',
                                'users.documento as documento',
                                'users.direccion as direccion',
                                'datos_comprador.barrio as barrio',
                                'datos_comprador.ciudad as ciudad',
                                'datos_comprador.estado_civil as estado_civil',
                                'datos_comprador.tipo_representacion as tipo_representacion',
                                'datos_comprador.ocupacion as ocupacion',
                                'datos_comprador.cargo as cargo',
                                'datos_comprador.empresa as empresa',
                                'datos_comprador.tipo_vinculacion as tipo_vinculacion',
                                'datos_comprador.tipo_contrato as tipo_contrato',
                                'datos_comprador.encuesta as encuesta',
                                'datos_comprador.id_usuario as id_usuario'
                                )
        ->join('propiedades','ventas.propiedad','=','propiedades.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->leftJoin('datos_comprador', 'users.id','=','datos_comprador.id_usuario')
        ->where([   ['ventas.id', '=', $id],
                    ['ventas.estado', '=', '1']
                    ])
        ->first();

        $comprador2 = User::select( 'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.tipo_documento as tipo_documento',
                                    'users.documento as documento',
                                    'users.direccion as direccion',
                                    'datos_comprador.barrio as barrio',
                                    'datos_comprador.ciudad as ciudad',
                                    'datos_comprador.estado_civil as estado_civil',
                                    'datos_comprador.tipo_representacion as tipo_representacion',
                                    'datos_comprador.ocupacion as ocupacion',
                                    'datos_comprador.cargo as cargo',
                                    'datos_comprador.empresa as empresa',
                                    'datos_comprador.tipo_vinculacion as tipo_vinculacion',
                                    'datos_comprador.tipo_contrato as tipo_contrato',
                                    'datos_comprador.encuesta as encuesta',
                                    'datos_comprador.id_usuario as id_usuario'
                                    )
        ->leftJoin('datos_comprador', 'users.id','=','datos_comprador.id_usuario')
        ->where('users.id','=',$venta->comprador2)
        ->first();

        return view('venta.cerrar', ['venta' => $venta, 'comprador2' => $comprador2]);    

    }

    // Para datatable

    public function getDataTableVentas(){
        $queryConsulta = Venta::select( 'ventas.id',
                                        'propiedades.codigo', 
                                        'users.name as comprador',
                                        'users.telefono as telefono',
                                        'propiedades.direccion',
                                        'tipos_propiedad.nombre as tipoPropiedad', 
                                        'proyectos.nombre as nombreProyec')
        ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->where('ventas.estado','=',1)
        ->get();
        return \DataTables::of($queryConsulta)->addColumn('editar', function ($venta) {
            $htmlString =  "";
            if (\Shinobi::can('verVentas')){
                $htmlString = $htmlString." ".'<a href="'.url('ventas/editar/'. $venta->id).'" class="btn btn-sm btn-primary">Editar</a>';
            }
            if (\Shinobi::can('propiedades.editar')){
                $htmlString = $htmlString." ".'<a href="'.url('ventas/anular/'. $venta->id).'" class="btn btn-sm btn-primary"> Anular</a>';
            }
            if (\Shinobi::can('verVentas')){
                $htmlString = $htmlString." ".'<a href="'.url('documentos/check/'. $venta->id).'" class="btn btn-sm btn-primary">Agregar Documentos</a>';
            }
            if (\Shinobi::can('venta.pdf')){
                $htmlString = $htmlString." ".'<a href="'.url('ventas/pdf/'. $venta->id).'" class="btn btn-sm btn-primary">PDF</a>';
            }
            if (\Shinobi::can('venta.pdf')){
                $htmlString = $htmlString." ".'<a href="'.url('ventas/cerrar/'. $venta->id).'" class="btn btn-sm btn-primary">Cerrar</a>';
            }
            return $htmlString;
        })->rawColumns(['editar', 'action'])->make(true);
    }

    public function getVentas(){
        return view('venta.ventas');
    }

    public function getAnularVenta($id){
        $venta = Venta::select(         'ventas.id',
                                        'propiedades.codigo', 
                                        'users.name as comprador',
                                        'propiedades.direccion',
                                        'tipos_propiedad.nombre as tipoPropiedad', 
                                        'proyectos.nombre as nombreProyec')
        ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->where('ventas.id','=',$id)
        ->get();
        return view('venta.anularVenta',['venta' => $venta[0]]);
    }

    public function postAnularVenta($id, Request $request){
        $novedad = new NovedadVenta;
        $novedad->venta_id = $id;
        $novedad->novedad = $request->input('novedades');
        $novedad->quien_registra_id = Auth::id();
        $novedad->save();
        $venta = Venta::find($id);
        $venta->estado = 0;
        $venta->save();
        return redirect('/verVentas');
    }

    public function pdf($id){
        $venta = Venta::select('proyectos.nombre as proyectoNombre',
        'propiedades.numero_piso','propiedades.codigo as codigoApto', 
        'tipos_propiedad.nombre as tipoPropiNombre',
        'propiedades.area_aproximada','propiedades.area_privada_aprox',
        'users.name','users.documento','datos_comprador.barrio', 'datos_comprador.direccion_correspondencia',
        'datos_comprador.ciudad', 'users.telefono', 'users.email', 
        'datos_comprador.estado_civil', 'datos_comprador.tipo_representacion',
        'datos_comprador.ocupacion', 'datos_comprador.cargo', 'datos_comprador.empresa',
        'datos_comprador.telefono as telefonoEmpresa', 'datos_comprador.tipo_vinculacion',
        'datos_comprador.tipo_contrato', 'datos_comprador.encuesta')
        ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->join('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')
        ->where('ventas.id','=',$id)
        ->get();
        
        $datosSegunCompra = Venta::select(
        'users.name','users.documento','datos_comprador.barrio',
        'datos_comprador.ciudad', 'users.telefono', 'users.email', 
        'datos_comprador.estado_civil', 'datos_comprador.tipo_representacion', 'datos_comprador.direccion_correspondencia',
        'datos_comprador.ocupacion', 'datos_comprador.cargo', 'datos_comprador.empresa',
        'datos_comprador.telefono as telefonoEmpresa', 'datos_comprador.tipo_vinculacion',
        'datos_comprador.tipo_contrato', 'datos_comprador.encuesta')
        ->join('users', 'ventas.comprador2', '=', 'users.id')
        ->join('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')
        ->where('ventas.id','=',$id)
        ->get();

        $pdf = PDF::loadView('venta.pdf', compact('venta','datosSegunCompra'));

        return $pdf->download('listado.pdf');
    }

    public function getEditarVenta($id){
        $venta = Venta::select( 'ventas.id as id',
                                'ventas.comprador as comprador',
                                'ventas.comprador2 as comprador2',
                                'propiedades.id as idPropiedad', 
                                'propiedades.codigo', 
                                'propiedades.nombre', 
                                'propiedades.direccion as direccionPropiedad', 
                                'propiedades.estado', 
                                'proyectos.nombre as nombreProyec',
                                'tipos_propiedad.nombre as tipo',
                                'tipos_propiedad.valor as valor',
                                'users.name as name',
                                'users.email as email',
                                'users.telefono as telefono',
                                'users.tipo_documento as tipo_documento',
                                'users.documento as documento',
                                'users.direccion as direccion',
                                'datos_comprador.barrio as barrio',
                                'datos_comprador.ciudad as ciudad',
                                'datos_comprador.estado_civil as estado_civil',
                                'datos_comprador.tipo_representacion as tipo_representacion',
                                'datos_comprador.ocupacion as ocupacion',
                                'datos_comprador.cargo as cargo',
                                'datos_comprador.empresa as empresa',
                                'datos_comprador.tipo_vinculacion as tipo_vinculacion',
                                'datos_comprador.tipo_contrato as tipo_contrato',
                                'datos_comprador.encuesta as encuesta',
                                'datos_comprador.id_usuario as id_usuario'
                                )
        ->join('propiedades','ventas.propiedad','=','propiedades.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->leftJoin('datos_comprador', 'users.id','=','datos_comprador.id_usuario')
        ->where([   ['ventas.id', '=', $id],
                    ['ventas.estado', '=', '1']
                    ])
        ->first();
        $comprador2 = User::select( 'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.tipo_documento as tipo_documento',
                                    'users.documento as documento',
                                    'users.direccion as direccion',
                                    'datos_comprador.barrio as barrio',
                                    'datos_comprador.ciudad as ciudad',
                                    'datos_comprador.estado_civil as estado_civil',
                                    'datos_comprador.tipo_representacion as tipo_representacion',
                                    'datos_comprador.ocupacion as ocupacion',
                                    'datos_comprador.cargo as cargo',
                                    'datos_comprador.empresa as empresa',
                                    'datos_comprador.tipo_vinculacion as tipo_vinculacion',
                                    'datos_comprador.tipo_contrato as tipo_contrato',
                                    'datos_comprador.encuesta as encuesta',
                                    'datos_comprador.id_usuario as id_usuario'
                                    )
        ->leftJoin('datos_comprador', 'users.id','=','datos_comprador.id_usuario')
        ->where('users.id','=',$venta->comprador2)
        ->first();
        
        $novedades = NovedadVenta::select(  'novedadesVentas.created_at as fecha',
                                            'novedadesVentas.novedad as novedad',
                                            'users.name as quienRegistra'
                                            )->where('venta_id','=',$id)
                                            ->join('users','novedadesVentas.quien_registra_id','=','users.id')
                                            ->get();

        $clienteExistenteRegistrado = 0;

        if(count($comprador2) != 0){
            $clienteExistenteRegistrado = 1;
        }

        $valor = (string) $venta->valor;
        $pos = strpos($valor, '.') - 3;
        $valor = substr_replace($valor, ',', $pos, 0);
        $valor = substr_replace($valor, '`', $pos-3, 0);
        $valor = substr_replace($valor, '$ ', 0, 0);
        
        return view('propiedad.completarVenta', ['venta' => $venta, 'comprador2' => $comprador2, 'clienteExistenteRegistrado' => $clienteExistenteRegistrado, 'valor' => $valor, 'novedades' => $novedades]);    
    }

    protected function validator2(array $data, $id_user){
        return Validator::make($data, [
            'users.documento' => 'required|unique:users,documento'.$id_user,
            'users.telefono' => 'required|unique:users,telefono,'.$id_user,
            'users.email' => 'required|unique:users,email'.$id_user,
        ]);
    }

    public function postEditarVenta($id, Request $request){
        $venta = Venta::find($id);
        $comprador = User::find($venta->comprador);
        //$this->validator2($request->all(),$comprador->id)->validate();        
        $comprador->name = $request->name;
        $comprador->email = $request->email;
        //$comprador->password = bcrypt($request->documento);
        $comprador->tipo_documento = $request->tipo_documento;
        $comprador->telefono = $request->telefono;
        $comprador->direccion = $request->direccion;
        $comprador->estado = 1;
        $comprador->save();
        
        

        $detallesAll = DatosComprador::where('id_usuario','=',$venta->comprador)->get();
        if(count($detallesAll) == 0){
            $detalles = new DatosComprador;
        } else{
            $detalles = $detallesAll[0];
        }
        $detalles->direccion_correspondencia = $request->direccion;
        $detalles->barrio = $request->barrio;
        $detalles->ciudad = $request->ciudad;
        $detalles->estado_civil = $request->estado_civil;
        $detalles->tipo_representacion = $request->tipo_representacion;
        $detalles->ocupacion = $request->ocupacion;
        $detalles->cargo = $request->cargo;
        $detalles->empresa = $request->empresa;
        $detalles->telefono = $request->telefono;
        $detalles->tipo_vinculacion = $request->tipo_vinculacion;
        $detalles->tipo_contrato = $request->tipo_contrato;
        $detalles->encuesta = $request->encuesta;
        $detalles->id_usuario = $venta->comprador;
        $detalles->save();
        
        if($request->segundoComprador != ""){
            $origenUsuario = $request->input('usuarioNoE');
            if($origenUsuario == "nuevo"){
                
                $this->validatorDoc($request->all())->validate();
                
                /*
                $docexist = User::where('documento','=',$request->documento)->get();

                if(count($docexist) > 0){
                    Notification::error('El documento que usú para el usuario 2 ya existe en la base de datos');
                    return redirect ('ventas/editar/'.$id);
                }*/
                
                $comprador2 = new User;
                $comprador2->name = $request->name2;
                $comprador2->email = $request->email2;
                //$comprador2->password = bcrypt($request->documento2);
                $comprador2->tipo_documento = $request->tipo_documento2;
                $comprador2->documento = $request->documento;
                $comprador2->telefono = $request->telefono2;
                $comprador2->direccion = $request->direccion2;
                $comprador2->estado = 1;
                $comprador2->save();


                $idComprador2 = $comprador2->id;
            
                $rolesUsers = new RolesUsers;
                $rolesUsers->user_id = $idComprador2;
                $rolesUsers->role_id = 3;
                $rolesUsers->save();
                
                Notification::success('Comprador 2 creado correctamente');
            } else {
                $idComprador2 = $request->input('id_usuario2');
                $comprador2 = User::find($idComprador2);
                $comprador2->name = $request->name2;
                $comprador2->email = $request->email2;
                $comprador2->password = bcrypt($request->documento2);
                $comprador2->documento = $request->documento2;
                $comprador2->telefono = $request->telefono2;
                $comprador2->direccion = $request->direccion2;
                $comprador2->estado = 1;
                $comprador2->save();
            }
            
            $detallesAll2 = DatosComprador::where('id_usuario','=',$idComprador2)->get();
            if(count($detallesAll2) == 0){
                $detalles2 = new DatosComprador;
            } else{
                $detalles2 = $detallesAll2[0];
            }
            $detalles2->direccion_correspondencia = $request->direccion2;
            $detalles2->barrio = $request->barrio2;
            $detalles2->ciudad = $request->ciudad2;
            $detalles2->estado_civil = $request->estado_civil2;
            $detalles2->tipo_representacion = $request->tipo_representacion2;
            $detalles2->ocupacion = $request->ocupacion2;
            $detalles2->cargo = $request->cargo2;
            $detalles2->empresa = $request->empresa2;
            $detalles2->telefono = $request->telefono2;
            $detalles2->tipo_vinculacion = $request->tipo_vinculacion2;
            $detalles2->tipo_contrato = $request->tipo_contrato2;
            $detalles2->encuesta = $request->encuesta2;
            $detalles2->id_usuario = $idComprador2;
            $detalles2->save();
            
            $venta->comprador2 = $idComprador2;
            $venta->save();
        }
        $cita = Agenda::where('venta','=',$id)->first();
        if(count($cita) == 0){
            $cita = new Agenda;
            
        }
        
        $cita->cliente = $comprador->id;
        $cita->venta = $id;
        $cita->event_name = 'Cita con '.$comprador->name.' ('.$comprador->telefono.')';
        $cita->start_date = $request->cita;
        $cita->end_date = $request->cita;
        try{
            $cita->save();                                   
        } catch(\Illuminate\Database\QueryException $ex) {
            Notification::error('Error al registrar la cita');
            return redirect ('ventas/editar/'.$id);
        }
        $novedad = new NovedadVenta;
        $novedad->venta_id = $id;
        $novedad->novedad = $request->input('novedades');
        $novedad->quien_registra_id = Auth::id();
        $novedad->save();

        Notification::success('Venta actualizada con exito');        
        return redirect('/verVentas');
        
    }
}