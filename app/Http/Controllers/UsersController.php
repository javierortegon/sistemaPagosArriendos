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
        $usuario = User::find($id);

        //vericar si el usuario tiene roles
        $count = User::select('users.id as id_user','rolesUsuarios.rol_id as rol')
        ->join('rolesUsuarios', 'users.id', '=', 'rolesUsuarios.user_id')
        ->where('users.id', '=', $id)
        ->count();

        //si tiene algun rol se carga la edicion
        if($count > 0){

            $rolesActivos = DB::table('rolesUsuarios')->where('user_id', '=', $id)->get();

            $rol1 = 0;
            $rol2 = 0;
            $rol3 = 0;
            
            foreach ($rolesActivos as $rolactivo) {
                if( $rolactivo->rol_id == 1){
                    $rol1 = 1;
                }else if($rolactivo->rol_id == 2){
                    $rol2 = 1;
                }else if($rolactivo->rol_id == 3){
                    $rol3 = 1;
                }
            }
            return view('auth.editRol', ['rol1' => $rol1, 'rol2' => $rol2, 'rol3' => $rol3, 'usuario' => $usuario]);
        }else{
        //si no tiene roles se crea un rol 3 al usuario y se carga la edicion    
            $rolesUsuarios = new RolesUsuarios;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->rol_id = 3;
            $rolesUsuarios->save();

            $rolesActivos = DB::table('rolesUsuarios')->where('user_id', '=', $id)->get();

            $rol1 = 0;
            $rol2 = 0;
            $rol3 = 0;
            
            foreach ($rolesActivos as $rolactivo) {
                if( $rolactivo->rol_id == 1){
                    $rol1 = 1;
                }else if($rolactivo->rol_id == 2){
                    $rol2 = 1;
                } else if($rolactivo->rol_id == 3){
                    $rol3 = 1;
                }
            }
            return view('auth.editRol', ['rol1' => $rol1, 'rol2' => $rol2, 'rol3' => $rol3, 'usuario' => $usuario]);
        }

    }

    public function putEditRol($id, Request $request){
        DB::table('rolesUsuarios')->where('user_id', '=', $id)->delete();
        //echo $request->estadoRol1 , $request->estadoRol2, $request->estadoRol3;
        //die();

        if($request->estadoRol1==1){
            $rolesUsuarios = new RolesUsuarios;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->rol_id = 1;
            $rolesUsuarios->save();
        }
        if ($request->estadoRol2 == 1){
            $rolesUsuarios = new RolesUsuarios;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->rol_id = 2;
            $rolesUsuarios->save();
        }
        if($request->estadoRol3 == 1){
            $rolesUsuarios = new RolesUsuarios;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->rol_id = 3;
            $rolesUsuarios->save();
        }
        $notificacion = new Notification;
        $notificacion::success('El usuario se ha actualizo correctamente');
        return redirect('verUsuarios');          
    }

}
