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
    // Método que lee el csv y pasa las columnas a la vista de elegir columna
    public function chooseColumns(Request $request){
        $csvpath = $request->file('import_file')->getRealPath();
        try {

            if (($handle = fopen ( $csvpath, 'r' )) !== FALSE) {
                $file = array();

                $file = array();
                while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                    array_push($file, $data);
                }
                $columns = $file[0];

                $fileString = "";
                foreach ($file as $row){
                    $fileString = $fileString.$row[0];
                    for($i = 1; $i < count($row); $i++){
                        $fileString = $fileString.",".$row[$i];
                    }
                    $fileString = $fileString.";";
                }
                
                fclose ( $handle );

                return view('importCsv.chooseColumnsCsv')->with('columns', $columns)->with('file', $fileString);
            }
        }
        catch (Exception $e) {
            echo 'Ocurrió un error al importar: ',  $e->getMessage(), "\n";
        }
    }
    
    // Método que recibe los indices de columna correspondiente a cada campo de la tabla de base de datos y realiza el insert en la base de datos.
    public function importCsv(Request $request){
        try {
            $file = $request->input('file');
            $rows = explode(";", $file);
            
            for($i = 0;$i < count($rows);$i++){
                $rows[$i] = explode(",", $rows[$i]);
            }
            
            for ($i = 0; $i < count($rows)-1; $i++) {
                $user = new User ();
                $user->name = $rows [$i][$request->input('name')];
                $user->email = $rows [$i][$request->input('email')];
                $user->password = $rows [$i][$request->input('password')];
                $user->estado = $rows [$i][$request->input('state')];
                $user->save ();
            }
            return redirect('/verUsuarios');
        }
        catch (Exception $e) {
            echo 'Ocurrió un error al importar: ',  $e->getMessage(), "\n";
        }
    }
    
    /*

    //Este método solo recibe el archivo y lo inserta en la base de datos en el orden en el que está.

    public function importCsv(Request $request){
        $csvpath = $request->file('import_file')->getRealPath();
        try {
            if (($handle = fopen ( $csvpath, 'r' )) !== FALSE) {
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
    */
}