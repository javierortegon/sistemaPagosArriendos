<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Propiedad;
use App\User;
use App\Proyecto;
use App\Venta;
use App\TiposPropiedad;
use App\Agenda;
use App\Documento;
use App\DatosComprador;


class ReportesController extends Controller
{
    public function reporteVentas(){

        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $ventas = Venta::select( 
                                    'ventas.created_at as fechaVenta',
                                    'propiedades.codigo', 
                                    'propiedades.nombre', 
                                    'propiedades.direccion as direccionPropiedad', 
                                    'proyectos.nombre as nombreProyec',
                                    'tipos_propiedad.nombre as tipo',
                                    'tipos_propiedad.valor as valor',
                                    'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.documento as documento',
                                    'users.direccion as direccion'
                                    )
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->join('users', 'ventas.comprador', '=', 'users.id')
                ->where([  ['ventas.estado', '=', '1'] ])
                ->get();
 
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteVentasTorre1(){

        Excel::create('VentasTorre1', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $ventas = Venta::select( 
                                    'ventas.created_at as fechaVenta',
                                    'propiedades.codigo', 
                                    'propiedades.nombre', 
                                    'propiedades.direccion as direccionPropiedad', 
                                    'proyectos.nombre as nombreProyec',
                                    'tipos_propiedad.nombre as tipo',
                                    'tipos_propiedad.valor as valor',
                                    'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.documento as documento',
                                    'users.direccion as direccion'
                                    )
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->join('users', 'ventas.comprador', '=', 'users.id')
                ->where([   ['ventas.estado', '=', '1'],
                            ['tipos_propiedad.nombre', '=', 'Torre 1'] 
                        ])
                ->get();
 
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteVentasTorre2(){

        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $ventas = Venta::select( 
                                    'ventas.created_at as fechaVenta',
                                    'propiedades.codigo', 
                                    'propiedades.nombre', 
                                    'propiedades.direccion as direccionPropiedad', 
                                    'proyectos.nombre as nombreProyec',
                                    'tipos_propiedad.nombre as tipo',
                                    'tipos_propiedad.valor as valor',
                                    'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.documento as documento',
                                    'users.direccion as direccion'
                                    )
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->join('users', 'ventas.comprador', '=', 'users.id')
                ->where([   ['ventas.estado', '=', '1'],
                            ['tipos_propiedad.nombre', '=', 'Torre 2'] 
                        ])
                ->get();
 
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function disponibles(){

        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $ventas = Propiedad::select( 
                                    'propiedades.codigo', 
                                    'propiedades.nombre', 
                                    'propiedades.direccion as direccionPropiedad', 
                                    'tipos_propiedad.nombre as tipo',
                                    'tipos_propiedad.valor as valor'
                                    )
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->whereNotIn('propiedades.id', function($query){
                    $query->select('ventas.propiedad')
                           ->from('ventas')
                           ->where('ventas.estado', '=', '1');
                })
                ->get();
 
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteVentasAnuladas(){

        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $ventas = Venta::select( 
                                    'ventas.created_at as fechaVenta',
                                    'propiedades.codigo', 
                                    'propiedades.nombre', 
                                    'propiedades.direccion as direccionPropiedad', 
                                    'proyectos.nombre as nombreProyec',
                                    'tipos_propiedad.nombre as tipo',
                                    'tipos_propiedad.valor as valor',
                                    'users.name as name',
                                    'users.email as email',
                                    'users.telefono as telefono',
                                    'users.documento as documento',
                                    'users.direccion as direccion'
                                    )
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->join('users', 'ventas.comprador', '=', 'users.id')
                ->where([   ['ventas.estado', '=', '0']
                        ])
                ->get();
 
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteCitasHoy(){
        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $carbon = new \Carbon\Carbon();
                $date = $carbon->now();
                $ventas = Agenda::select('event_name as nombre cita',
                'agenda.start_date as fecha cita',
                'propiedades.nombre as nombre propiedad',
                'propiedades.codigo',
                'users.name',
                'users.email',
                'users.telefono')
                ->join('ventas','agenda.venta','=','ventas.id')
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('users','agenda.cliente','=','users.id')
                ->whereDate('start_date', '=', date('Y-m-d'))
                ->get();
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteCitasMes(){
        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $carbon = new \Carbon\Carbon();
                $date = $carbon->now();
                $ventas = Agenda::select('event_name as nombre cita',
                'agenda.start_date as fecha cita',
                'propiedades.nombre as nombre propiedad',
                'propiedades.codigo',
                'users.name',
                'users.email',
                'users.telefono')
                ->join('ventas','agenda.venta','=','ventas.id')
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('users','agenda.cliente','=','users.id')
                ->whereMonth('start_date', '=', date('m'))
                ->get();
                $sheet->fromArray($ventas);
 
            });
        })->export('xlsx');
    }

    public function reporteVentaFiducia(){
        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $carbon = new \Carbon\Carbon();
                $date = $carbon->now();
                $ventas = Documento::select(
                    'ventas.created_at as fechaVenta',
                    'propiedades.codigo', 
                    'propiedades.nombre', 
                    'propiedades.direccion as direccionPropiedad', 
                    'documentos.documento as Tipo Documento',
                    'documentos.informacion_adicional as Numero Tarjeta Fiducia',
                    'users.name as name',
                    'users.email as email',
                    'users.telefono as telefono',
                    'users.documento as documento',
                    'users.direccion as direccion')
                ->join('ventas','documentos.venta_id','=','ventas.id')
                ->join('propiedades','ventas.propiedad','=','propiedades.id')
                ->join('users','ventas.id','=','users.id')
                ->where([   ['documentos.documento', '=', 'Tarjeta de Fiducia'],
                            ['documentos.informacion_adicional', '!=', ''] 
                ])
                //->whereMonth('start_date', '=', date('m'))
                ->get();
                $sheet->fromArray($ventas);
 
            });
        
        })->export('xlsx');
    }

    public function reporteEncuesta(){
        Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $carbon = new \Carbon\Carbon();
                $date = $carbon->now();
                $ventas = DatosComprador::select(
                'encuesta as Tipo',
                DB::raw('count(*) as total'))
                ->groupBy('encuesta')
                //->whereMonth('start_date', '=', date('m'))
                ->get();
                $sheet->fromArray($ventas);
 
            });
        
        })->export('xlsx');
    }
    
}
