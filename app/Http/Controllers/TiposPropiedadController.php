<?php

namespace App\Http\Controllers;

use App\TiposPropiedad;
use App\Proyecto;
use Notification;

use Illuminate\Http\Request;

class TiposPropiedadController extends Controller
{
    public function tiposPropiedad($id){
        $tiposPropiedades = TiposPropiedad::where([
            ['proyecto', '=', $id]
        ])->get();
        $proyecto = Proyecto::findOrFail($id);
        return view ('tiposPropiedad.tipos', [ 'tiposPropiedad' => $tiposPropiedades, 'proyecto' => $proyecto ]);
    }

    public function postCreate($id, Request $request){
        $tipoProyecto = new TiposPropiedad;
        $tipoProyecto->nombre = $request->nombre;
        $tipoProyecto->descripcion = $request->descripcion;
        $tipoProyecto->proyecto = $id;
        $tipoProyecto->save();
        $notification = new Notificacion;
        $notification::success('El tipo de inmueble fue regisrado con exito');
        return redirect('/proyectos');
    }
    
}
