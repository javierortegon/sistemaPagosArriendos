<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Venta;
use App\Cartera;

use Notification;

class CarterasController extends Controller
{
    public function postCerrarVenta($id, Request $request){
        $venta = Venta::find($id);
        $venta->estado = 3;
        $venta->save();

        $cartera = new Cartera;
        $cartera->venta = $id;
        $cartera->numero_cuota = 1;
        $cartera->valor = $request->pagoInicial;
        $cartera->confirmado = true;
        $cartera->fecha_pago = $request->fechaPago;
        $cartera->save();
        $notification = new Notification;
        $notification::success('Cartera iniciada correctamente');
        return redirect('/verVentas');
    }

    public function consultarGet(){
        return view('cartera.cartera');
                
    }

    // Para datatable

    public function getDataTableCartera(){

        $queryConsulta = Venta::select(
        'users.name as cliente',
        'users.documento as cliente_documento',
        'ventas.id as id',
        'carteras.numero_cuota as cuotas_pagadas',
        'carteras.fecha_pago as fecha_pago',
        'propiedades.codigo as inmueble',
        'tipos_propiedad.nombre as tipoPropiedad',
        'tipos_propiedad.cuota_inicial as cuota_inicial',
        'tipos_propiedad.valor as valor_total',
        'proyectos.nombre as nombreProyec',
        's.suma as total_pagado')
        ->leftJoin('propiedades', 'ventas.propiedad', '=', 'propiedades.id')
        ->leftJoin('users', 'ventas.comprador', '=', 'users.id')
        ->leftJoin('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->leftJoin('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->leftJoin('carteras', function($query) {
            $query->on('ventas.id','=','carteras.venta')
            ->whereRaw('carteras.id IN (select MAX(c.id) from carteras as c join ventas as v on v.id = c.venta 
                        group by v.id)');
        })
        ->leftJoin(\DB::Raw('(select carteras.venta as venta, SUM(carteras.valor) as suma from ventas 
                            join carteras on ventas.id = carteras.venta group by carteras.venta) s'), 
                            's.venta','=','ventas.id')
        ->whereNotNull('carteras.venta')
        ->get();

        return \DataTables::of($queryConsulta)
        ->addColumn('total_deuda', function($cartera){
            return $cartera->valor_total - $cartera->total_pagado;
        })
        ->addColumn('estadoString', function($cartera){
            $fechaActual=new \DateTime(date('Y-m-j'));
            $fechaUltimoPago = new \DateTime(date('Y-m-d',strtotime($cartera->fecha_pago)));
            $intervalo=$fechaActual->diff($fechaUltimoPago);
            $intervaloMeses=$intervalo->format("%m");
            $intervaloDias=$intervalo->format("%d");
            $intervaloAnnos=$intervalo->format("%y");
            $intervalo = $intervaloMeses + $intervaloAnnos*12;
            $estado = "Al día";
            if($intervalo >30){
                $estado = "En mora";
            }
            return $estado;
        })
        ->addColumn('acciones', function ($venta) {
            $htmlString =  "";
            if (\Shinobi::can('verVentas')){
                $htmlString = $htmlString." ".'<a href="'.url('cartera/administrarPagos/'. $venta->id).'" class="btn btn-sm btn-primary">Administrar pagos</a>';
            }
            if (\Shinobi::can('venta.pdf')){
                $htmlString = $htmlString." ".'<a href="'.url('cartera/detalles/'. $venta->id).'" class="btn btn-sm btn-primary">Detalles</a>';
            }
            return $htmlString;
        })->rawColumns(['acciones', 'action'])->make(true);
    }
    public function getAdministrarPagos($id_venta){
        //Consulta de datos necesarios
        return view('cartera.pagos');
    }
}
