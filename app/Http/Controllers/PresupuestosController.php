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
        $tiposPropiedad = TiposPropiedad::select(
            'tipos_propiedad.id as id',
            'tipos_propiedad.nombre as nombre',
            'tipos_propiedad.valor as valor',
            'tipos_propiedad.cuota_inicial as cuota_inicial',
            'tipos_propiedad.descripcion as descripcion',
            'tipos_propiedad.proyecto as proyecto',
            'proyectos.nombre as nombreProyecto',
            'proyectos.direccion as direccion',
            'proyectos.fecha_finalizacion as fecha_finalizacion'
        )
        ->join('proyectos', 'tipos_propiedad.proyecto','=','proyectos.id')->get();
        //$fechaActual=new DateTime(date('Y-m-j'));
        //$fechaFin = new DateTime(date('Y-m-d',strtotime($tiposPropiedad[1]->fecha_finalizacion)));
        //$intervalo=$fechaFin->diff($fechaActual);
        //$intervaloMeses=$intervalo->format("%m");
        //$intervaloAnnos=$intervalo->format("%y");
        //$intervalo = $intervaloMeses + $intervaloAnnos*12;
        $proyectos = Proyecto::all();
        return view('presupuesto.generarPresupuesto', compact('tiposPropiedad','proyectos'));
    }
    public function postGenerarPresupuesto(Request $request){
        $primerPagoString = $request->input('primerPago');
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
        $presupuesto->usuario_que_registra = Auth::id();
        $presupuesto->save();

        $datosTipoPropiedad = Propiedad::select('proyectos.nombre as proyectoNombre',
        'proyectos.fecha_finalizacion as fecha_finalizacion',
        'tipos_propiedad.nombre as tipoPropiNombre',
        'tipos_propiedad.cuota_inicial as cuota_inicial',
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
        ->leftJoin('datos_comprador', 'users.id', '=', 'datos_comprador.id_usuario')
        ->where('users.id','=',$request->input('inputUserId'))
        ->first();
     
        $valorCadaCuota = ($datosTipoPropiedad->cuota_inicial - $primerPago)/$numeroDeCuotas;
        $saldo_credito = $datosTipoPropiedad->valor - $datosTipoPropiedad->cuota_inicial;
        $valores = [
            'valorCadaCuota' => $this->formatoMoneda($valorCadaCuota,".",",","$ "),
            'valor_primer_pago' => $this->formatoMoneda($presupuesto->valor_primer_pago,".",",","$ "),
            'cuota_inicial' => $this->formatoMoneda($datosTipoPropiedad->cuota_inicial,".",",","$ "),
            'valor_total' => $this->formatoMoneda($datosTipoPropiedad->valor,".",",","$ "),
            'saldo_credito' => $this->formatoMoneda($saldo_credito,".",",","$ ")
        ];
        $fechas = array();
        for($i =0;$i<$numeroDeCuotas;$i++){
            $fechas[$numeroDeCuotas-$i-1] = date('Y-m-d',strtotime ('-'.$i.' months', strtotime($datosTipoPropiedad->fecha_finalizacion)));
        }
        $pdf = PDF::loadView('presupuesto.pdf', compact('datosTipoPropiedad','datosComprador','valores','presupuesto','fechas'));
        return $pdf->download('presupuesto'.$datosComprador->name.'.pdf');
    }
    public function formatoMoneda($stringNumero,$separadorDecimal,$separadorDeMiles,$signoMoneda){
        $posIni = strlen($stringNumero);
        $posDec = strpos($stringNumero,$separadorDecimal);
        if($posDec > 0){
            $posIni = $posDec;
        }
        $posAct = $posIni - 3;
        while ($posAct >=1) {
            $izq = substr($stringNumero,0,$posAct);
            $der = substr($stringNumero,$posAct,(strlen($stringNumero) - $posAct));
            $stringNumero = $izq.$separadorDeMiles.$der;
            $posAct = $posAct -3;
        }
        $stringNumero = $signoMoneda.$stringNumero;
        return $stringNumero;
    }
}