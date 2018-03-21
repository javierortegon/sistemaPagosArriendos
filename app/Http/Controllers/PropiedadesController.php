<?php

namespace App\Http\Controllers;

use App\Propiedad;
use DB;
use App\User;
use App\Propietario;
use App\Arrendatario;
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
        $estadoArriendo = DB::table('users')->count();
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

    public function getAddArrendatario($id){
        $propiedad = Propiedad::findOrFail($id);

        $arrendatario = Arrendatario::select('users.name as name','users.id as id')
        ->join('users', 'arrendatarios.arrendatario_id_usuario', '=', 'users.id')
        ->where('arrendatarios.propiedad_id', '=', $id)
        ->where('arrendatarios.estado', '=', 1)
        ->get();;

        $usuarios = User::select('users.name as name','users.id as id')
        ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
        ->where('rolesUsuarios.rol_id', '=', 2)
        ->get();

        return view ('propiedad.addArrendatario', 
        ['propiedad' => $propiedad, 'usuarios' => $usuarios, 'arrendatario' => $arrendatario]);
    }

    public function putAddArrendatario($id, Request $request){
        Arrendatario::where('propiedad_id', $id)
          ->update(['estado' => 0]);
        $arrendatario = new Arrendatario;
        $arrendatario->arrendatario_id_usuario = $request->arrendatario;
        $arrendatario->propiedad_id = $id;
        $arrendatario->save();
        $notificacion = new Notification;
        $notificacion::success('Arrendatario asigando correctamente');
        return redirect('verPropiedades');          
    }
}
