<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $cartera->fecha_pago = $request->fechaPago;
        $cartera->save();
        $notification = new Notification;
        $notification::success('Cartera iniciada correctamente');
        return redirect('/verVentas');
    }
}
