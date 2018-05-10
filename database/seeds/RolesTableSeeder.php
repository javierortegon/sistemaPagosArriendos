<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

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
        Role::create([
            'name' => 'admin',
            'slug' => 'admin',
            'special' => 'all-access',
        ]);

        Role::create([
            'name' => 'vendedor',
            'slug' => 'vendedor',
        ]);

        Role::create([
            'name' => 'cliente',
            'slug' => 'cliente',
        ]);

    }
}
