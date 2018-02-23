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
		$user->save();
	}
}
