<?php

namespace App\Http\Controllers;

use App\Propiedad;
use DB;
use App\User;
use App\Propietario;
use App\Arrendatario;
use Notification;

use Illuminate\Http\Request;

class ArrendatariosController extends Controller
{
    public function getAddArrendatario($id){
        $propiedad = Propiedad::findOrFail($id);

        $arrendatario = Arrendatario::select('users.name as name','users.id as id', 'fecha_factura', 'valor_arriendo')
        ->join('users', 'arrendatarios.arrendatario_id_usuario', '=', 'users.id')
        ->where('arrendatarios.propiedad_id', '=', $id)
        ->where('arrendatarios.estado', '=', 1)
        ->get();

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
        $arrendatario->estado = 1;
        $arrendatario->save();
        $notificacion = new Notification;
        $notificacion::success('Arrendatario asigando correctamente');
        return redirect('verPropiedades');          
    }

    public function getEdit($id){
        $arrendatario = Arrendatario::where([
            ['propiedad_id', '=', $id],
            ['estado', '=', '1'],
        ])->get();
        return view ('propiedad.editArrendatario', ['arrendatarioData' => $arrendatario, 'idPropiedad' => $id]);
    }

    public function putEdit($id, Request $request){
        $arrendatario = Arrendatario::where([
            ['propiedad_id', '=', $id],
            ['estado', '=', '1'],
        ])->update(['fecha_factura' => $request->fecha_factura, 'valor_arriendo' => $request->valor_arriendo]);
            
    }
}
