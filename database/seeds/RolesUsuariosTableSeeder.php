<?php

use Illuminate\Database\Seeder;
use App\RolesUsuarios;

class RolesUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedRolesUsuarios();
		$this->command->info('Tabla rolesUsuarios inicializada con datos!');
    }

    private function seedRolesUsuarios(){
        RolesUsuarios::create(array('user_id' => 1, 'rol_id' => 1));
        RolesUsuarios::create(array('user_id' => 1, 'rol_id' => 3));
    }

}
