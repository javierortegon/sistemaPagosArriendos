<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Rol;
use App\RolesUsuarios;
use App\RolesUsers;
use App\Venta;

use Illuminate\Http\Request;
use Notification;

class UsersController extends Controller
{
    public function getUsuarios(){
        $usuariosPaginados = User::paginate(10);
        return view ('auth.usuarios', ['usuarios' => $usuariosPaginados ]);
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
        $count = User::select('users.id as id_user','role_user.role_id as rol')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->where('users.id', '=', $id)
        ->count();

        //si tiene algun rol se carga la edicion
        if($count > 0){

            $rolesActivos = DB::table('role_user')->where('user_id', '=', $id)->get();

            $rol1 = 0;
            $rol2 = 0;
            $rol3 = 0;
            
            foreach ($rolesActivos as $rolactivo) {
                if( $rolactivo->role_id == 1){
                    $rol1 = 1;
                }else if($rolactivo->role_id == 2){
                    $rol2 = 1;
                }else if($rolactivo->role_id == 3){
                    $rol3 = 1;
                }
            }
            return view('auth.editRol', ['rol1' => $rol1, 'rol2' => $rol2, 'rol3' => $rol3, 'usuario' => $usuario]);
        }else{
        //si no tiene roles se crea un rol 3 al usuario y se carga la edicion    
            $rolesUsuarios = new RolesUsers;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->role_id = 3;
            $rolesUsuarios->save();

            $rolesActivos = DB::table('role_user')->where('user_id', '=', $id)->get();

            $rol1 = 0;
            $rol2 = 0;
            $rol3 = 0;
            
            foreach ($rolesActivos as $rolactivo) {
                if( $rolactivo->role_id == 1){
                    $rol1 = 1;
                }else if($rolactivo->role_id == 2){
                    $rol2 = 1;
                } else if($rolactivo->role_id == 3){
                    $rol3 = 1;
                }
            }
            return view('auth.editRol', ['rol1' => $rol1, 'rol2' => $rol2, 'rol3' => $rol3, 'usuario' => $usuario]);
        }

    }

    public function putEditRol($id, Request $request){
        DB::table('role_user')->where('user_id', '=', $id)->delete();
        //echo $request->estadoRol1 , $request->estadoRol2, $request->estadoRol3;
        //die();

        if($request->estadoRol1==1){
            $rolesUsuarios = new RolesUsers;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->role_id = 1;
            $rolesUsuarios->save();
        }
        if ($request->estadoRol2 == 1){
            $rolesUsuarios = new RolesUsers;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->role_id = 2;
            $rolesUsuarios->save();
        }
        if($request->estadoRol3 == 1){
            $rolesUsuarios = new RolesUsers;
            $rolesUsuarios->user_id = $id;
            $rolesUsuarios->role_id = 3;
            $rolesUsuarios->save();
        }
        $notificacion = new Notification;
        $notificacion::success('El usuario se ha actualizo correctamente');
        return redirect('verUsuarios');          
    }

    //Datos para AJAX

    public function selectAjax($campo, $caracteres){
        //$caracteres = $request->input('busqueda');
        //$campo = $request->input('campo');

        $usuarios = DB::table('users')
        ->join('role_user', 'users.id', '=', 'role_user.user_id')
        ->select('users.id as id', 'users.name', 'users.email', 'users.documento', 'users.telefono','users.direccion')
        ->where([
            [$campo, 'LIKE', $caracteres.'%'],
            ['role_user.role_id', '=', '3']
        ])
        ->get();
        return response()->json($usuarios);
    }

    public function getDataTableUsuarios(){
        
        $queryConsulta = User::all();
        return \DataTables::of($queryConsulta)->addColumn('estadoString', function ($user) {
            $estado = "";
            if($user->estado == 1){
                $estado = 'Activo';
            } else{
                $estado = 'Inactivo';
            }
            return $estado;
            
        })->addColumn('roles', function ($user) {
            $roles =    RolesUsers::select('roles.name')
                        ->join('roles','role_user.role_id','=','roles.id')
                        ->where('role_user.user_id','=',$user->id)
                        ->get();

            $rolesString = "- ";
            if(count($roles) != 0){
                foreach($roles as $rol){
                    $rolesString = $rolesString.$rol->name." - ";
                }
            } else{
                $rolesString = "Sin rol asignado";
            }
            return $rolesString;
            
        })->addColumn('editar', function ($user) {
            return  '<a href="'.url('usuario/detalles/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles</a>'." ".
                    '<a href="'.url('usuario/edit/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>'." ".
                    '<a href="'.url('usuario/editRol/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Modificar Roles</a>';
        })->rawColumns(['editar', 'action'])->make(true);

    }

    public function getDetallesUsuario($id){
        $usuario =  User::select('id','name','email','documento','telefono','direccion','estado')
                    ->where('users.id', '=', $id)
                    ->get();
        $propiedades =  Venta::select('propiedades.codigo as codigo','proyectos.nombre as proyecto','proyectos.direccion as direccion','tipos_propiedad.nombre as tipo')
                        ->join('propiedades','ventas.propiedad','=','propiedades.id')
                        ->join('proyectos', 'propiedades.id_proyecto','=','proyectos.id')
                        ->join('tipos_propiedad','propiedades.id_tipoPropiedad','=','tipos_propiedad.id')
                        ->where('ventas.comprador','=',$id)
                        ->paginate(10);
        $roles =    RolesUsers::select('roles.name as rol')
                    ->join('roles','role_user.role_id','=','roles.id')
                    ->where('role_user.user_id','=',$id)
                    ->get();

        return view ('auth.detallesUsuario', ['usuario' => $usuario[0], 'roles' => $roles, 'propiedades' => $propiedades]);
    }
}
