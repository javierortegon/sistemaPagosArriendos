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

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropiedadesController extends Controller
{

    public function getRegister(){
        $proyectos = Proyecto::all();
        return view ('propiedad.add', ['proyectos' => $proyectos]);
    }

    public function postCreate(Request $request){
        $propiedad = new Propiedad;
        $propiedad->direccion = $request->direccion;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->codigo = $request->codigo;
        $propiedad->nombre = $request->nombre;
        $propiedad->numero_piso = $request->numeroPiso;
        $propiedad->area_aproximada = $request->areaArquitec;
        $propiedad->area_privada_aprox = $request->AreaPrivaApro;
        $propiedad->estado = 1;
        $propiedad->id_proyecto = $request->proyecto;
        $propiedad->id_tipoPropiedad = $request->tipoPropiedad;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha guardado correctamente');
        return redirect('/registroPropiedad');
    }

    public function addArrendatario(){
        $propiedades = Propiedad::all()->where('estado', '=', 1);
        return view ('propiedad.addArrendatario', ['propiedades' => $propiedades, 'users' => $usuarios]);
    }

    public function postAddArrendatario(Request $request){
        $propietario = new Propietario;
        $propietario->propietario_id_usuario = $request->propietario;
        $propietario->propiedad_id = $request->propiedad;
        $propietario->estado = $request->estado;
        $propietario->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha guardado correctamente');
        return redirect('/asignarArrendatario');
    }

    public function getPropiedades(){
        $propiedades = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre', 'propiedades.direccion', 'propiedades.estado', 'proyectos.nombre as nombreProyec')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->get();
        return view ('propiedad.propiedades', ['propiedades' => $propiedades ]);
    }

    public function getEdit($id){
        $proyectos = Proyecto::all();
        $propiedad = Propiedad::findOrFail($id);
        return view ('propiedad.edit', ['propiedad' => $propiedad, 'proyectos' => $proyectos]);
    }

    public function putEdit($id, Request $request){
        $propiedad = Propiedad::find($id);
        $propiedad->direccion = $request->direccion;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->codigo = $request->codigo;
        $propiedad->nombre = $request->nombre;
        $propiedad->numero_piso = $request->numeroPiso;
        $propiedad->area_aproximada = $request->areaArquitec;
        $propiedad->area_privada_aprox = $request->AreaPrivaApro;
        $propiedad->estado = $request->estado;
        $propiedad->id_proyecto = $request->proyecto;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha actualizo correctamente');
        return redirect('verPropiedades');
    }

    public function getProyectoTipos(Request $request, $id){
        if($request->ajax()){
            $tiposPropiedad = TiposPropiedad::where([
                ['proyecto', '=', $id]
            ])->get();
            return response()->json($tiposPropiedad);
        }
    }

    // Para datatable

    public function getDataTablePropiedades(){
        
        $queryConsulta = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre', 'propiedades.numero_piso',
         'propiedades.direccion', 'propiedades.estado', 'tipos_propiedad.nombre as tipoPropiedad', 
         'proyectos.nombre as nombreProyec')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id') 
        ->get();
        return \DataTables::of($queryConsulta)->addColumn('estadoString', function ($propiedad) {
            $estado = "";
            if($propiedad->estado == 1){
                $estado = 'Activo';
            } else{
                $estado = 'Inactivo';
            }
            return $estado;
            
        })->addColumn('estadoVenta', function ($propiedad) {
            $ventas = Venta::where('ventas.propiedad', '=', $propiedad->id)->get();
            $estadoVenta = "Disponible";
            
            foreach($ventas as $venta){
                if($venta->estado == 1){
                    $estadoVenta = "Vendida";
                }
            }
            return $estadoVenta;
            
        })->addColumn('numeroPiso', function ($propiedad){
            return "Piso_".$propiedad->numero_piso;
        })->addColumn('editar', function ($propiedad) {
            $ventas = Venta::select('ventas.estado')->where('ventas.propiedad', '=', $propiedad->id)->get();
            $ventaEstado = 0;
            foreach($ventas as $venta){
                if($venta->estado == 1){
                    $ventaEstado = 1;
                }
            }
            $htmlString =   "";
            if (\Shinobi::can('propiedades.vender')){
                $htmlString = $htmlString." ".'<a href="'.url('propiedad/detalles/'. $propiedad['id']).'" class="btn btn-sm btn-primary">Ver detalles</a>';
                if($ventaEstado != 1){
                    $htmlString = $htmlString." ".'<a href="'.url('propiedad/vender/'. $propiedad['id']).'" class="btn btn-sm btn-primary">Vender</a>';
                } else {
                    $htmlString = $htmlString." ".'<a class="btn btn-sm btn-warning" disabled>Vender</a>';                
                }
            }
            if (\Shinobi::can('propiedades.editar')){
                $htmlString = $htmlString." ".'<a href="'.url('propiedad/edit/'. $propiedad['id']).'" class="btn btn-sm btn-primary">Editar</a>';
            }
            return $htmlString;

        })->rawColumns(['editar', 'action'])->make(true);

    }

    public function getDetallesPropiedad($id){
        $propiedades = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre',
         'propiedades.direccion', 'propiedades.estado', 'tipos_propiedad.nombre as tipoPropiedad', 
         'proyectos.nombre as nombreProyec', 'ventas.estado as ventaEstado', 'users.name as nombreComprador', 
         'users.email as correoComprador', 'propiedades.numero_piso', 'propiedades.area_aproximada', 'propiedades.area_privada_aprox')
        ->leftJoin('ventas', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->leftJoin('users', 'ventas.comprador', '=', 'users.id')
        ->where('propiedades.id', '=', $id)
        ->get();

        $propiedad = $propiedades[count($propiedades)-1];
        
        return view ('propiedad.detallesPropiedad', ['propiedad' => $propiedad ]);
    }
}
