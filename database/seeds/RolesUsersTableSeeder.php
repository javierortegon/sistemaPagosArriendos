<?php

use Illuminate\Database\Seeder;
use App\RolesUsers;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolesUsers::create([
            'role_id' => '1',
            'user_id' => '1'
        ]);

        RolesUsers::create([
            'role_id' => '2',
            'user_id' => '2'
        ]);

        RolesUsers::create([
            'role_id' => '3',
            'user_id' => '3'
        ]);

        $this->command->info('Tabla de roles-usuarios inicializada');
    }
}
