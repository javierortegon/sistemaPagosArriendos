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

use Barryvdh\DomPDF\Facade as PDF;

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return view ('propiedad.venta', ['propiedad' => $propiedad]);
        }

    }

    public function postVender($id, Request $request){
        $origenUsuario = $request->input('usuarioNoE');
        if($origenUsuario == "nuevo"){
            $comprador = new User;
            $comprador->name = $request->name;
            $comprador->email = $request->email;
            $comprador->password = bcrypt($request->documento);
            $comprador->documento = $request->documento;
            $comprador->telefono = $request->telefono;
            $comprador->direccion = $request->direccion;
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
            $venta->valor = $request->valor;
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

    // Para datatable

    public function getDataTableVentas(){
        $queryConsulta = Venta::select( 'ventas.id',
                                        'propiedades.codigo', 
                                        'users.name as comprador',
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
            return  '<a href="'.url('ventas/anular/'. $venta->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Anular venta</a>';
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

    public function pdf(){
        $venta = Venta::select('proyectos.nombre as proyectoNombre',
        'propiedades.numero_piso','propiedades.codigo as codigoApto', 
        'tipos_propiedad.nombre as tipoPropiNombre',
        'propiedades.area_aproximada','propiedades.area_privada_aprox',
        '')
        ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->join('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')
        //->where('ventas.id','=',$id)
        ->get(); 

        $pdf = PDF::loadView('venta.pdf', compact('venta'));

        return $pdf->download('listado.pdf');
    }

    public function getEditarVenta($id){
        $venta = Venta::select( 'propiedades.id as id', 
                                'propiedades.codigo', 
                                'propiedades.nombre', 
                                'propiedades.direccion', 
                                'propiedades.estado', 
                                'proyectos.nombre as nombreProyec',
                                'tipos_propiedad.nombre as tipo',
                                'tipos_propiedad.valor as valor')
        ->join('propiedades','ventas.propiedad','=','propiedades.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->where([   ['ventas.id', '=', $id],
                    ['ventas.estado', '=', '1']
                    ])
        ->get();
        return view('propiedad.completarVenta', ['propiedad' => $venta]);    
    }

    public function postEditarVenta($id){
    }
}