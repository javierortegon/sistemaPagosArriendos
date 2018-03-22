<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Http\Request;
use App\User;

class ImportCsvController extends BaseController
{
    public function importCsv(Request $request){
        $direccion = $request->file('import_file')->getRealPath();
        try {
            if (($handle = fopen ( $direccion, 'r' )) !== FALSE) {
                while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                    
                    $user = new User ();
                    $user->name = $data [0];
                    $user->email = $data [1];
                    $user->password = $data [2];
                    $user->estado = $data [3];
                    $user->save ();
                }
                echo "Se importaron los usuarios correctamente";

                return redirect('/verUsuarios');

                fclose ( $handle );
            }
        }
        catch (Exception $e) {
            echo 'Ocurrió un error al importar: ',  $e->getMessage(), "\n";
        }
    }
}