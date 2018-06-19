<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Rol;
use App\RolesUsuarios;
use App\RolesUsers;
use App\Venta;
use App\DatosComprador;

use Illuminate\Http\Request;
use Notification;

class UsersController extends Controller
{
    public function getUsuarios(){
        return view ('auth.usuarios');
    }

    public function getClientes(){
        return view ('auth.clientes');
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
        $usuario->documento = $request->documento;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
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
        
        if($request->estadoRol1 != 1 and $request->estadoRol2 != 1 and $request->estadoRol3 != 1){
            $notificacion = new Notification;
            $notificacion::error('El usuario debe tener al menos un rol');
            return redirect('verUsuarios');  
        }else{
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
    }

    public function postRegistroUsuarioRol(Request $request){
        //  return $request->all();
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->documento = $request->documento;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->estado = 1;
        $usuario->password = bcrypt($request->password);
        $usuario->save();

        if($request->rolCliente == 1){
            $rol = new RolesUsers;
            $rol->role_id = 3;
            $rol->user_id = $usuario->id;
            $rol->save();
        }

        if($request->rolVendedor == 1){
            $rol = new RolesUsers;
            $rol->role_id = 2;
            $rol->user_id = $usuario->id;
            $rol->save();
        }
        
        if($request->rolAdmin == 1){
            $rol = new RolesUsers;
            $rol->role_id = 1;
            $rol->user_id = $usuario->id;
            $rol->save();
        }
        
        $notification = new Notification;
        $notification::success('Usuario Registrado con exito');
        return redirect('/verUsuarios');

    }

    public function registroUsuarioPresupuesto(Request $request){
        $usuario = new User;
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->tipo_documento = $request->tipo_documento;
        $usuario->documento = $request->documento;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->estado = 1;
        $usuario->password = bcrypt($request->documento);
        $usuario->save();

        $detalles = new DatosComprador;
        $detalles->direccion_correspondencia = $request->direccion;
        $detalles->barrio = $request->barrio;
        $detalles->ciudad = $request->ciudad;
        $detalles->estado_civil = $request->estado_civil;
        $detalles->tipo_representacion = $request->tipo_representacion;
        $detalles->ocupacion = $request->ocupacion;
        $detalles->cargo = $request->cargo;
        $detalles->empresa = $request->empresa;
        $detalles->telefono = $request->telefono;
        $detalles->tipo_vinculacion = $request->tipo_vinculacion;
        $detalles->tipo_contrato = $request->tipo_contrato;
        $detalles->encuesta = $request->encuesta;
        $detalles->id_usuario = $usuario->id;
        $detalles->save();
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
        ->select(   'users.id as id', 
                    'users.name', 
                    'users.email', 
                    'users.documento', 
                    'users.telefono',
                    'users.direccion',
                    'datos_comprador.barrio as barrio',
                    'datos_comprador.ciudad as ciudad',
                    'datos_comprador.estado_civil as estado_civil',
                    'datos_comprador.tipo_representacion as tipo_representacion',
                    'datos_comprador.ocupacion as ocupacion',
                    'datos_comprador.cargo as cargo',
                    'datos_comprador.empresa as empresa',
                    'datos_comprador.tipo_vinculacion as tipo_vinculacion',
                    'datos_comprador.tipo_contrato as tipo_contrato',
                    'datos_comprador.encuesta as encuesta',
                    'datos_comprador.id_usuario as id_usuario'
                    )
        ->leftJoin('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')        
        ->where([
            ['users.'.$campo, 'LIKE', $caracteres.'%'],
            ['role_user.role_id', '=', '3']
        ])
        ->get();
        return response()->json($usuarios);
    }

    public function getDataTableClientes(){
        $idRolDeCliente = 3;
        $queryConsulta =    User::select(   'users.id',
                                            'users.name',
                                            'users.email',
                                            'users.telefono',
                                            'users.documento',
                                            'users.estado',
                                            'role_user.role_id as rol')
                            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', '=', 3)->get();
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
            $htmlString =  "";
            if (\Shinobi::can('verUsuarios')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/detalles/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles</a>';
            }
            if (\Shinobi::can('usuarios.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/edit/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            }
            if (\Shinobi::can('usuarios.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/editRol/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Modificar Roles</a>';
            }
            return $htmlString;
        })->rawColumns(['editar', 'action'])->make(true);
    }

    public function getDataTableUsuarios(){
        $idRolDeCliente = 3;
        $queryConsulta =    User::select(   'users.id',
                                            'users.name',
                                            'users.email',
                                            'users.telefono',
                                            'users.documento',
                                            'users.estado',
                                            'role_user.role_id as rol')
                            ->leftJoin('role_user', 'role_user.user_id', '=', 'users.id')
                            ->where('role_user.role_id', '<>', 3)
                            ->orWhereNull('role_user.role_id')->get();
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
            $htmlString =  "";
            if (\Shinobi::can('verUsuarios')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/detalles/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles</a>';
            }
            if (\Shinobi::can('usuarios.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/edit/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
            }
            if (\Shinobi::can('usuarios.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('usuario/editRol/'. $user['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Modificar Roles</a>';
            }
            return $htmlString;
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
