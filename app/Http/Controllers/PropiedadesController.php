<?php

namespace App\Http\Controllers;

use App\Propiedad;
use DB;
use Notification;

use Illuminate\Http\Request;

class PropiedadesController extends Controller
{
    public function postCreate(Request $request){
        $propiedad = new Propiedad;
        $propiedad->direccion = $request->direccion;
        $propiedad->descripcion = $request->descripcion;
        $propiedad->save();
        $notificacion = new Notification;
        $notificacion::success('La propiedad se ha guardado correctamente');
        return redirect('/registroPropiedad');
    }
}
