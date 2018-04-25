<?php

namespace App\Http\Controllers;

use App\Proyecto;
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
}
