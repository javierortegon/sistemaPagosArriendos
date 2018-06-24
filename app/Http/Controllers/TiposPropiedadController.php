<?php

namespace App\Http\Controllers;

use App\TiposPropiedad;
use App\Proyecto;
use App\Propiedad;

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
        $valor = doubleval($request->valor);
        $cuotaInicial = doubleval($request->cuotaInicial);

        $tipoPropiedad = new TiposPropiedad;
        $tipoPropiedad->nombre = $request->nombre;
        $tipoPropiedad->descripcion = $request->descripcion;
        $tipoPropiedad->valor = $valor;
        $tipoPropiedad->cuota_inicial = $cuotaInicial;
        $tipoPropiedad->proyecto = $id;
        $tipoPropiedad->save();
        $notification = new Notification;
        $notification::success('El tipo de inmueble fue regisrado con exito');
        return redirect('/proyectos');
    }


    public function getEditTipoPropiedad($id){
        $tipoPropiedad = TiposPropiedad::findOrFail($id);
        return view ('tiposPropiedad.edit', [ 'tipoPropiedad' => $tipoPropiedad ]);
    }

    public function putEditTipoPropiedad($id, Request $request){
        $valor = doubleval($request->valor);
        $cuotaInicial = doubleval($request->cuotaInicial);
        
        $tipoPropiedad = TiposPropiedad::findOrFail($id);
        $tipoPropiedad->nombre = $request->nombre;
        $tipoPropiedad->descripcion = $request->descripcion;
        $tipoPropiedad->valor = $valor;
        $tipoPropiedad->cuota_inicial = $cuotaInicial;
        $tipoPropiedad->save();
        $notification = new Notification;
        $notification::success('Tipo de propiedad actualizada exitosamente');
        return redirect('/proyectos');
    }
    
    public function deleteTipo($id, Request $request){
        $propiedadTipo = Propiedad::where([
            ['id_tipoPropiedad', '=', $id]
        ])->count();
        
        if($propiedadTipo > 0){
            $notification = new Notification;
            $notification::warning('No se puede eliminar este tipo ya que cuenta con propiedades asociadas');
            return redirect('/proyectos');
        }else{
            $tipoPropiedad = TiposPropiedad::find($id);
            $tipoPropiedad->delete();
            $notification = new Notification;
            $notification::success('Tipo de propiedad eliminada con exito');
            return redirect('/proyectos');
        }
    }
    
}
