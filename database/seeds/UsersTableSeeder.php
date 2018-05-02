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
		$user = new User;
		$user->name = ('javier ortegon');
		$user->email = ('javierortegon@ggg.com');
        $user->password = bcrypt('password');
        $user->documento = ('888654');
        $user->telefono = ('432423432');
        $user->direccion = ('carrera 24 # 4');
        $user->estado = 1;
		$user->save();
	}
}
