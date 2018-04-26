<?php

namespace App\Http\Controllers;

use App\TiposPropiedad;
use App\Proyecto;
use DB;
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
        $notification = new Notification;
        $notification::success('El tipo de inmueble fue regisrado con exito');
        return redirect('/proyectos');
    }

    public function getEditTipoPropiedad($id){
        $tipoPropiedad = TiposPropiedad::findOrFail($id);
        return view ('tiposPropiedad.edit', [ 'tipoPropiedad' => $tipoPropiedad ]);
    }

    public function putEditTipoPropiedad($id, Request $request){
        $tipoPropiedad = TiposPropiedad::findOrFail($id);
        $tipoPropiedad->nombre = $request->nombre;
        $tipoPropiedad->descripcion = $request->descripcion;
        $tipoPropiedad->save();
        $notification = new Notification;
        $notification::success('Tipo de propiedad actualizada exitosamente');
        return redirect('/proyectos');
    }
    
    public function deleteTipo($id, Request $request){
        $tipoPropiedad = TiposPropiedad::find($id);
        $tipoPropiedad->delete();
        $notification = new Notification;
        $notification::success('Tipo de propiedad eliminada con exito');
        return redirect('/proyectos');
    }
    
}
