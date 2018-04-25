<?php

namespace App\Http\Controllers;

use App\Propiedad;
use DB;
use App\User;
use App\Propietario;
use App\Proyecto;
use App\Arrendatario;
use App\Venta;
use Notification;

use Illuminate\Http\Request;

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
        //$propiedades = Propiedad::all();
        //$estadoArriendo = DB::table('users')->count();
        $propiedades = Propiedad::select('propiedades.id as id', 'propiedades.codigo', 'propiedades.nombre', 'propiedades.direccion', 'propiedades.estado', 'proyectos.nombre as nombreProyec')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->paginate(10);
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
        return view ('propiedad.venta', ['propiedad' => $propiedad]);
    }

    public function postVender($id, Request $request){
        $comprador = new User;
        $comprador->name = $request->name;
        $comprador->email = $request->email;
        $comprador->password = bcrypt($request->documento);
        $comprador->estado = 1;
        $comprador->save();

        $idComprador = $comprador->id;

        $venta = new Venta;
        $venta->fecha = date('Y-m-d');
        $venta->valor = $request->valor;
        $venta->metodo_pago = $request->metodoPago;
        $venta->estado = 1;
        $venta->propiedad = $id;
        $venta->comprador = $idComprador;
        $venta->save();    
    }

}
