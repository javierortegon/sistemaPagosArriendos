<?php

namespace App\Http\Controllers;

use DB;

use App\Propiedad;
use App\User;
use App\Propietario;
use App\Proyecto;
use App\Arrendatario;
use App\TiposPropiedad;
use App\NovedadVenta;
use App\DatosComprador;

use Barryvdh\DomPDF\Facade as PDF;

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresupuestosController extends Controller
{
    public function getGenerarPresupuesto(){
        $tiposPropiedad = TiposPropiedad::all();
        return view('presupuesto.generarPresupuesto', compact('tiposPropiedad'));
    }
    public function postGenerarPresupuesto(Request $request){
        dd($request);
    }
}