<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
		$this->command->info('Tabla usuarios inicializada con datos!');
    }

    private function seedUsers(){
		User::create([
		    'name' => 'admin',
		    'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'documento' => '888654',
            'telefono' => '432423432',
            'direccion' => 'carrera 24 # 4',
            'estado' => 1
        ]);

        User::create([
		    'name' => 'vendedor',
		    'email' => 'vendedor@vendedor.com',
            'password' => bcrypt('vendedor123'),
            'documento' => '888654',
            'telefono' => '432423432',
            'direccion' => 'carrera 24 # 4',
            'estado' => 1
        ]);

        User::create([
		    'name' => 'cliente',
		    'email' => 'cliente@cliente.com',
            'password' => bcrypt('cliente123'),
            'documento' => '888654',
            'telefono' => '432423432',
            'direccion' => 'carrera 24 # 4',
            'estado' => 1
        ]);
	}
}
