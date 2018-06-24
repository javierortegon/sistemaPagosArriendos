<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\TiposPropiedad;
use App\Propiedad;
use App\Venta;

use Notification;

use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function postCrearProyecto(Request $request){
        $proyecto = new Proyecto;
        $proyecto->nombre = $request->nombre;
        $proyecto->direccion = $request->direccion;
        $proyecto->numero_de_pisos = $request->numeroPisos;
        $proyecto->numero_de_apartamentos = $request->numeroApartamentos;
        $proyecto->fecha_finalizacion = $request->fachaFinalizacion;
        $proyecto->save();
        $notification = new Notification;
        $notification::success('El proyecto se guardo correctamente');
        return redirect('/proyectos');
    }

    public function getProyectos(){
        $proyectos = Proyecto::all();
        return view ('proyecto.proyectos', ['proyectos' => $proyectos]);
    }

    public function getEditProyecto($id){
        $proyecto = Proyecto::findOrFail($id);
        return view ('proyecto.edit', ['Proyecto' => $proyecto]);
    }

    public function putEditProyecto($id, Request $request){
        $proyecto = Proyecto::find($id);
        $proyecto->nombre = $request->nombre;
        $proyecto->direccion = $request->direccion;
        $proyecto->numero_de_pisos = $request->numeroPisos;
        $proyecto->numero_de_apartamentos = $request->numeroApartamentos;
        $proyecto->fecha_finalizacion = $request->fachaFinalizacion;
        $proyecto->save();
        $notification = new Notification;
        $notification::success('Proyecto editado exitosamente');
        return redirect('proyectos');
    }

    public function detalleProyecto($id){
        $proyecto = Proyecto::find($id);
        $tiposPropiedad = TiposPropiedad::where([
            ['proyecto', '=', $id]
        ])->get();
        $propiedades = Propiedad::select(   'propiedades.id',
                                            'propiedades.codigo',
                                            'propiedades.nombre',
                                            'propiedades.direccion',
                                            'ventas.estado as estadoVenta',
                                            'tipos_propiedad.nombre as tipoPropiedad')
        ->where('id_proyecto', '=', $id)
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad','=','tipos_propiedad.id')
        ->leftJoin('ventas', 'ventas.propiedad', '=', 'propiedades.id')
        ->where('ventas.estado','<>','0')
        ->orWhereNull('ventas.propiedad')
        ->paginate(10);
        

        return view ('proyecto.detalle', ['proyecto' => $proyecto, 'propiedades' => $propiedades, 'tiposPropiedad' => $tiposPropiedad]);
    }

    //Para dataTable

    public function getDataTableProyectos(){
        
        $queryConsulta = Proyecto::all();
        return \DataTables::of($queryConsulta)->addColumn('editar', function ($proyecto) {
            $htmlString =   "";
            if (\Shinobi::can('proyectos.detalle')){
                $htmlString = $htmlString." ".'<a href="'.url('proyecto/detalle/'. $proyecto['id']).'" class="btn btn-sm btn-primary">Detalles proyecto</a>';
            }
            if (\Shinobi::can('proyectos.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('proyecto/edit/'. $proyecto['id']).'" class="btn btn-sm btn-primary">Editar</a>';
            }
            if (\Shinobi::can('proyectos.edit')){
                $htmlString = $htmlString." ".'<a href="'.url('tiposPropiedad/'. $proyecto['id']).'" class="btn btn-sm btn-primary">Administrar tipos de inmueble</a>';
            }
            return $htmlString;
        })->rawColumns(['editar', 'action'])->make(true);
    }
}
