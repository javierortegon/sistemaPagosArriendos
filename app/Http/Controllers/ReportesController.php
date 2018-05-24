<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

use App\Propiedad;
use App\User;
use App\Proyecto;
use App\Venta;
use App\TiposPropiedad;

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
}
