<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\TiposPropiedad;
use App\Propiedad;

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
        $propiedades = Propiedad::where([
            ['id_proyecto', '=', $id]
        ])->paginate(10);
        return view ('proyecto.detalle', ['proyecto' => $proyecto, 'propiedades' => $propiedades, 'tiposPropiedad' => $tiposPropiedad]);
    }

    //Para dataTable

    public function getDataTableProyectos(){
        
        $queryConsulta = Proyecto::all();
        return \DataTables::of($queryConsulta)->addColumn('editar', function ($proyecto) {
            return  '<a href="'.url('proyecto/detalle/'. $proyecto['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver detalles del proyecto</a>'." ".
                    '<a href="'.url('tiposPropiedad/'. $proyecto['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Ver tipos de inmueble</a>'." ".
                    '<a href="'.url('proyecto/edit/'. $proyecto['id']).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>';
        })->rawColumns(['editar', 'action'])->make(true);

    }
}
