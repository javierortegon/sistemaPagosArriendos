<?php

namespace App\Http\Controllers;

use App\Propiedad;
use DB;
use App\User;
use App\Propietario;
use Notification;

use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    public function postCreate(Request $request){
        $propiedad = new Propiedad;
        $propiedad->direccion = $request->direccion;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->codigo = $request->codigo;
        $propiedad->nombre = $request->nombre;
        $propiedad->estado = 1;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha guardado correctamente');
        return redirect('/registroPropiedad');
    }

    public function addArrendatario(){
        $propiedades = Propiedad::all()->where('estado', '=', 1);
        $usuarios = User::all();
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
        $propiedades = Propiedad::all();
        return view ('propiedad.propiedades', ['propiedades' => $propiedades ]);
    }

    public function getEdit($id){
        $propiedad = Propiedad::findOrFail($id);
        return view ('propiedad.edit', ['propiedad' => $propiedad]);
    }

    public function putEdit($id, Request $request){
        $propiedad = Propiedad::find($id);
        $propiedad->direccion = $request->direccion;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->codigo = $request->codigo;
        $propiedad->nombre = $request->nombre;
        $propiedad->estado = $request->estado;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha actualizo correctamente');
        return redirect('verPropiedades');
    }
}
