<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Http\Request;
use App\User;
use App\Rol;
use App\Propiedad;
use App\RolesUsers;

use Notification;

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
                $columnsCsv = $file[0];

                
                $fileString = "";
                foreach ($file as $row){
                    $fileString = $fileString.$row[0];
                    for($i = 1; $i < count($row); $i++){
                        $fileString = $fileString.",".$row[$i];
                    }
                    $fileString = $fileString.";";
                }
                
                fclose ( $handle );
                
                //consultando que columnas tiene la tabla y pasandoselas a la vistaS

                $origen = $request->input('origen');
                if($origen=="usuarios"){
                    $table = 'users';
                    $columnasTablaQ = \DB::select("SHOW COLUMNS FROM ". $table);
                    $columnasTabla = array();
                    for($i = 1; $i <count($columnasTablaQ)-3;$i++){
                        $columnasTabla[$i-1] = $columnasTablaQ[$i]->Field;
                    }
                }
                else if ($origen == "propiedades"){
                    $table = 'propiedades';
                    $columnasTablaQ = \DB::select("SHOW COLUMNS FROM ". $table);
                    $columnasTabla = array();
                    for($i = 1; $i <count($columnasTablaQ)-2;$i++){
                        $columnasTabla[$i-1] = $columnasTablaQ[$i]->Field;
                    }
                }
                return view('importCsv.chooseColumnsCsv')->with('columns', $columnsCsv)->with('file', $fileString)->with('origen', $origen)->with('columnsTable', $columnasTabla);
            }
        }
        catch (Exception $e) {
            echo 'Ocurrió un error al importar: ',  $e->getMessage(), "\n";
        }
    }
    
    // Método que recibe los indices de columna correspondiente a cada campo de la tabla de base de datos y realiza el insert en la base de datos.
    public function importUsers(Request $request){
        try {
            $file = $request->input('file');
            $rows = explode(";", $file);
            $origen = $request->input('origen');
            
            for($i = 0;$i < count($rows);$i++){
                $rows[$i] = explode(",", $rows[$i]);
            }
            if($origen == 'usuarios'){
                for ($i = 1; $i < count($rows)-1; $i++) {
                    $user = new User ();
                    $user->name = $rows [$i][$request->input('name')];
                    $user->email = $rows [$i][$request->input('email')];
                    $user->password = $rows [$i][$request->input('password')];
                    $user->documento = $rows [$i][$request->input('documento')];
                    $user->tipo_documento = $rows [$i][$request->input('tipo_documento')];
                    $user->telefono = $rows [$i][$request->input('telefono')];
                    $user->direccion = $rows [$i][$request->input('direccion')];
                    $user->estado = $rows [$i][$request->input('estado')];
                    $user->save ();

                    $RolesUsers = new RolesUsers;
                    $RolesUsers->user_id = $user->id;
                    $RolesUsers->role_id = 3;
                    $RolesUsers->save();
                }
                $notificacion = new Notification;
                $notificacion::success('Usuarios cargados correctamente');
                return redirect('/verUsuarios');
            }
            else if($origen == 'propiedades'){
                for ($i = 1; $i < count($rows)-1; $i++) {
                    $propiedad = new Propiedad ();
                    $propiedad->direccion = $rows [$i][$request->input('direccion')];
                    $propiedad->descripcion = $rows [$i][$request->input('descripcion')];
                    $propiedad->nombre = $rows [$i][$request->input('nombre')];
                    $propiedad->codigo = $rows [$i][$request->input('codigo')];
                    $propiedad->estado = $rows [$i][$request->input('estado')];
                    $propiedad->numero_piso = $rows [$i][$request->input('numero_piso')];
                    $propiedad->area_aproximada = $rows [$i][$request->input('area_aproximada')];
                    $propiedad->area_privada_aprox = $rows [$i][$request->input('area_privada_aprox')];
                    $propiedad->id_proyecto = $rows [$i][$request->input('id_proyecto')];
                    $propiedad->id_tipoPropiedad = $rows [$i][$request->input('id_tipoPropiedad')];
                    $propiedad->save ();
                }
                $notificacion = new Notification;
                $notificacion::success('Propiedades cargadas correctamente');
                return redirect('/verPropiedades');
            }
            
        }
        catch (Exception $e) {
            $notificacion = new Notification;
            $notificacion::error('Ocurrió un error al cargar los usuarios');
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