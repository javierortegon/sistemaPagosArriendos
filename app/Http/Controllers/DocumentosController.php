<?php

namespace App\Http\Controllers;

use DB;

use App\Propiedad;
use App\User;
use App\Propietario;
use App\Proyecto;
use App\Arrendatario;
use App\Venta;
use App\TiposPropiedad;
use App\RolesUsers;
use App\NovedadVenta;
use App\DatosComprador;
use App\Agenda;
use App\Documento;

use Barryvdh\DomPDF\Facade as PDF;

use Notification;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DocumentosController extends Controller
{ 
    public function getCheckDocumentos($idVenta){
        $venta = Venta::select(         'ventas.id as id',
                                        'propiedades.codigo', 
                                        'users.name as comprador',
                                        'users.documento as documento',
                                        'users.telefono as telefono',
                                        'propiedades.direccion',
                                        'tipos_propiedad.nombre as tipoPropiedad', 
                                        'proyectos.nombre as nombreProyec')
        ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
        ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
        ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
        ->join('users', 'ventas.comprador', '=', 'users.id')
        ->where('ventas.id','=',$idVenta)
        ->first();
        $documentosQueTiene = array(    0 => 0, 
                                        1 => 0,
                                        2 => 0,
                                        3 => 0,
                                        4 => 0,
                                        5 => 0);
        $documentos =   Documento::select('id','created_at', 'fecha_entrega', 'documento', 'informacion_adicional')
                        ->where('venta_id','=',$idVenta)
                        ->get();
        $numeroTarjetaFiducia = "";
        foreach ($documentos as $documento){
            if($documento->documento == "Encargo Fiduciario"){
                $documentosQueTiene[0] = 1;
            } else if ($documento->documento == "Cedula"){
                $documentosQueTiene[1] = 1;
            } else if ($documento->documento == "Certificacion Laboral"){
                $documentosQueTiene[2] = 1;                
            } else if ($documento->documento == "Declaracion de Renta"){
                $documentosQueTiene[3] = 1;            
            } else if ($documento->documento == "Subsidio"){
                $documentosQueTiene[4] = 1;                
            } else if ($documento->documento == "Tarjeta de Fiducia"){
                $documentosQueTiene[5] = 1;
                $numeroTarjetaFiducia = $documento->informacion_adicional;              
            }
        }
        $novedades = NovedadVenta::select(  'novedadesVentas.created_at as fecha',
                                            'novedadesVentas.novedad as novedad',
                                            'users.name as quienRegistra'
                                            )->where('venta_id','=',$idVenta)
                                            ->join('users','novedadesVentas.quien_registra_id','=','users.id')
                                            ->get();
        return view('venta.agregarDocumentos',['venta' => $venta, 'documentos' => $documentos,'novedades' => $novedades, 'documentosQueTiene' => $documentosQueTiene, 'numeroTarjetaFiducia' => $numeroTarjetaFiducia]);
    }

    public function putRegistrarDocumentos($id, Request $request){
        $venta = $request->venta;
        if($request->encargoFiduciario != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->encargoFiduciario]
            ])->count();
            if($test>0){
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_encargo;
                $documento->documento = $request->encargoFiduciario;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->encargoFiduciario.' registrado con exito'); 
            }
        }
        if($request->cedula != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->cedula]
            ])->count();
            if($test>0){
                Notification::error('Ya existia el documento '.$request->cedula); 
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_cedula;
                $documento->documento = $request->cedula;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->cedula.' registrado con exito'); 
            }
        }
        if($request->certificacionLaboral != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->certificacionLaboral]
            ])->count();
            if($test>0){
                Notification::error('Ya existia el documento '.$request->certificacionLaboral); 
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_certificacionLaboral;
                $documento->documento = $request->certificacionLaboral;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->certificacionLaboral.' registrado con exito'); 
            }
        }
        if($request->declaracionDeRenta != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->declaracionDeRenta]
            ])->count();
            if($test>0){
                Notification::error('Ya existia el documento '.$request->declaracionDeRenta); 
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_declaracionDeRenta;
                $documento->documento = $request->declaracionDeRenta;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->declaracionDeRenta.' registrado con exito'); 
            }
        }
        if($request->subsidio != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->subsidio]
            ])->count();
            if($test>0){
                Notification::error('Ya existia el documento '.$request->subsidio); 
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_subsidio;
                $documento->documento = $request->subsidio;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->subsidio.' registrado con exito'); 
            }
        }
        if($request->tarjetaDeFiducia != ""){
            $test = Documento::where([
                ['venta_id','=',$id],
                ['documento','=',$request->tarjetaDeFiducia]
            ])->count();
            if($test>0){
                Notification::error('Ya existia el documento '.$request->tarjetaDeFiducia); 
            } else{
                $documento = new Documento;
                $documento->fecha_entrega = $request->fecha_entrega_tarjetaDeFiducia;
                $documento->documento = $request->tarjetaDeFiducia;
                $documento->informacion_adicional = $request->numeroTarjetaFiducia;
                $documento->venta_id = $id;
                $documento->save();
                Notification::success($request->tarjetaDeFiducia.' registrado con exito'); 
            }
        }
        $novedad = new NovedadVenta;
        $novedad->venta_id = $id;
        $novedad->novedad = $request->input('novedades');
        $novedad->quien_registra_id = Auth::id();
        $novedad->save();
        return redirect('documentos/check/'.$id);
    }

    public function getEliminarDocumentos($idVenta){
        $documentos =   Documento::select('id','created_at', 'fecha_entrega', 'documento', 'informacion_adicional','venta_id')
                        ->where('venta_id','=',$idVenta)
                        ->get();
        $venta = Venta::select(         'ventas.id as id',
                                        'propiedades.codigo', 
                                        'users.name as comprador',
                                        'users.documento as documento',
                                        'users.telefono as telefono',
                                        'propiedades.direccion',
                                        'tipos_propiedad.nombre as tipoPropiedad', 
                                        'proyectos.nombre as nombreProyec')
                ->leftJoin('propiedades', 'propiedades.id', '=', 'ventas.propiedad')
                ->join('tipos_propiedad', 'propiedades.id_tipoPropiedad', '=', 'tipos_propiedad.id')
                ->join('proyectos', 'propiedades.id_proyecto', '=', 'proyectos.id')
                ->join('users', 'ventas.comprador', '=', 'users.id')
                ->where('ventas.id','=',$idVenta)
                ->first();

        return view('venta.eliminarDocumentos', ['documentos' => $documentos, 'venta' => $venta]);
    }
    public function eliminarDocumentos(Request $request){
        $eliminado = false;
        for($i = 0; $i < $request->numeroDeDocumentos;$i++){
            $id = $request->input('eliminar_'.$i);
            if($id>0){
                $documento = Documento::find($id);
                $documento->delete();
                $eliminado = true;
            }
        }
        if($eliminado){
            Notification::success('Documentos eliminados correctamente');
        } else {
            Notification::warning('No se han eliminado documentos');
            
        }
        return redirect('documentos/check/'.$request->idVenta);
    }    
}