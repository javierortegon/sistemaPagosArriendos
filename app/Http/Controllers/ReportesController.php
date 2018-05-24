<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ReportesController extends Controller
{
    public function prueba888(){
        Excel::create('ventas', function($excel){
            $excel->sheet('ventas', function($sheet){
                $sheet->loadView('reporte.ventas');
            });
        })->export('xlsx');
    }
}
