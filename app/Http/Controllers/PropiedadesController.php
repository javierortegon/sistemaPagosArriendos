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
        $propiedad->estado = $request->estado;
        $propiedad->id_proyecto = $request->proyecto;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha actualizo correctamente');
        return redirect('verPropiedades');
    }

    public function getVender($id){
        $propiedad = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre', 'propiedades.direccion', 'propiedades.estado', 'proyectos.nombre as nombreProyec')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
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
        
        $consultaVenta = DB::table('ventas')
                        ->where([
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

            $consulta2Venta = DB::table('ventas')
            ->where([
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
        
        $queryConsulta = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre',
         'propiedades.direccion', 'propiedades.estado', 'tipos_propiedad.nombre as tipoPropiedad', 
         'proyectos.nombre as nombreProyec', 'ventas.estado as ventaEstado')
        ->leftJoin('ventas', 'propiedades.id', '=', 'ventas.propiedad')
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
            $estadoVenta = "";
            if($propiedad->ventaEstado != 1){
                $estadoVenta = "Disponible";
            }else{
                $estadoVenta = "Vendida";
            }
          
            return $estadoVenta;
            
        })->addColumn('editar', function ($propiedad) {
            if($propiedad->ventaEstado != 1){
                return  '<a href="'.url('propiedad/detalles/'. $propiedad['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles</a>'." ".
                        '<a href="'.url('propiedad/edit/'. $propiedad['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>'." ".
                        '<a href="'.url('propiedad/vender/'. $propiedad['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Vender</a>';
            } else {
                return  '<a href="'.url('propiedad/detalles/'. $propiedad['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles</a>'." ".
                        '<a href="'.url('propiedad/edit/'. $propiedad['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>'." ".
                        '<a class="btn btn-xs btn-warning" disabled><i class="glyphicon glyphicon-edit"></i> Vender</a>';
            }
            
        })->rawColumns(['editar', 'action'])->make(true);

    }

    public function getDetallesPropiedad($id){
        $propiedad = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre',
         'propiedades.direccion', 'propiedades.estado', 'tipos_propiedad.nombre as tipoPropiedad', 
         'proyectos.nombre as nombreProyec', 'ventas.estado as ventaEstado', 'users.name as nombreComprador', 'users.email as correoComprador')
        ->leftJoin('ventas', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->leftJoin('users', 'ventas.comprador', '=', 'users.id')
        ->where('propiedades.id', '=', $id)
        ->get();
        
        return view ('propiedad.detallesPropiedad', ['propiedad' => $propiedad[0] ]);
    }
}
