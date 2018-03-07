<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Rol;
use App\RolesUsuarios;

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

        //vericar si el usuario tiene roles
        $count = User::select('users.id as id_user','rolesUsuarios.rol_id as rol')
        ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
        ->where('users.id', '=', $id)
        ->count();

        //si tiene algun rol se carga la edicion
        if($count > 0){
            $roles = User::select('users.id as id_user','rolesUsuarios.rol_id as rol')
            ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
            ->where('users.id', '=', $id)
            ->get();
            return view('auth.editRol', ['roles' => $roles,'usuario' => $id]);
        }else{
        //si no tiene roles se crea un rol 3 al usuario y se carga la edicion    
            $rolesUsuarios = new RolesUsuarios;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->rol_id = 3;
            $rolesUsuarios->save();

            $roles = User::select('users.id as id_user','rolesUsuarios.rol_id as rol')
            ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
            ->where('users.id', '=', $id)
            ->get();
            return view('auth.editRol', ['roles' => $roles,'usuario' => $id]);
        }

    }

}
