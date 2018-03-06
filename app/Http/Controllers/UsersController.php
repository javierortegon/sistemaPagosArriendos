<?php

namespace App\Http\Controllers;

use DB;
use App\User;

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

}
