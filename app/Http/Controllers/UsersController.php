<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Rol;

use Illuminate\Http\Request;
use Notification;

class UsersController extends Controller
{
    public function getUsuarios(){
        $usuarios = User::all();
        return view ('auth.usuarios', ['usuarios' => $usuarios ]);
    }

    public function getEdit($id){
        $usuario = User::findOrFail($id);
        return view ('auth.edit', ['usuario' => $usuario]);
    }

    public function putEdit($id, Request $request){
        $usuario = User::find($id);
        $usuario->name = $request->nombre;
        $usuario->email = $request->email;
        $usuario->estado = $request->estado;
        $usuario->save();
        $notificacion = new Notification;
        $notificacion::success('El usuario se ha actualizo correctamente');
        return redirect('verUsuarios');
    }

    public function getEditRol($id){
        $roles = User::select('users.id as id_user','rolesUsuarios.rol_id as rol')
        ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
        ->get();
        return view ('auth.editRol')->with('roles', $roles);
    }

}
