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
use App\Presupuesto;

use Barryvdh\DomPDF\Facade as PDF;

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresupuestosController extends Controller
{
    private $signoMoneda = "$";
    private $separadorDecimal = ".";
    private $separadorDeMiles = ",";

    public function getGenerarPresupuesto(){
        $tiposPropiedad = TiposPropiedad::all();
        return view('presupuesto.generarPresupuesto', compact('tiposPropiedad'));
    }
    public function postGenerarPresupuesto(Request $request){
        $primerPago = $request->input('primerPago');
        $primerPago = str_replace(" ", "",$primerPago);
        $primerPago = str_replace($this->signoMoneda, "",$primerPago);
        $primerPago = str_replace($this->separadorDeMiles, "",$primerPago);
        $primerPago = doubleval($primerPago);
        $numeroDeCuotas = (int) $request->input('numeroDeCuotas');

        $presupuesto = new Presupuesto;
        $presupuesto->id_usuario = $request->input('inputUserId');
        $presupuesto->tipo_propiedad = $request->input('tipoPropiedad');
        $presupuesto->valor_primer_pago = $primerPago;
        $presupuesto->numero_de_cuotas = $numeroDeCuotas;
        $presupuesto->save();

        /*
        $datosPropiedad = Propiedad::select('proyectos.nombre as proyectoNombre',
        'tipos_propiedad.nombre as tipoPropiNombre',
        'tipos_propiedad.valor as valor',
        'propiedades.area_aproximada','propiedades.area_privada_aprox')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->where('tipos_propiedad.id','=',$request->input('tipoPropiedad'))
        ->first();

        $datosComprador = User::select(
        'users.name','users.documento','datos_comprador.barrio',
        'datos_comprador.ciudad', 'users.telefono', 'users.email', 
        'datos_comprador.estado_civil', 'datos_comprador.tipo_representacion', 'datos_comprador.direccion_correspondencia',
        'datos_comprador.ocupacion', 'datos_comprador.cargo', 'datos_comprador.empresa',
        'datos_comprador.telefono as telefonoEmpresa', 'datos_comprador.tipo_vinculacion',
        'datos_comprador.tipo_contrato', 'datos_comprador.encuesta')
        ->join('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')
        ->where('users.id','=',$request->input('inputUserId'))
        ->fist();

        $cuotaInicial = $datosPropiedad['valor']/2;        
        $valorCadaCuota = ($cuotaInicial - $primerPago)/$numeroDeCuotas;
        
        $pdf = PDF::loadView('venta.pdf', compact('venta','datosSegunCompra'));

        return $pdf->download('listado.pdf');
        */
    }
}