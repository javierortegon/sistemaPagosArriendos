<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Borramos los datos de la tabla
         DB::table('roles')->delete();

         // Añadimos una entrada a esta tabla
         Rol::create(array('nombre' => 'administrador'));
         Rol::create(array('nombre' => 'arrendatario'));
         Rol::create(array('nombre' => 'propietario'));
    }
}
