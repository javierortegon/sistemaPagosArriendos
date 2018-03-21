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
        self::seedRoles();
		$this->command->info('Tabla roles inicializada con datos!');
    }

    private function seedRoles(){
        Rol::create(array('nombre' => 'administrador'));
        Rol::create(array('nombre' => 'arrendatario'));
        Rol::create(array('nombre' => 'propietario'));
    }
}
