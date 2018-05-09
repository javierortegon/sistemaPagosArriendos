<?php

use Illuminate\Database\Seeder;
use App\PermissionsRoles;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionsRoles::create([
            'permission_id' => 2,
            'role_id' => 2
        ]);

        PermissionsRoles::create([
            'permission_id' => 4,
            'role_id' => 2
        ]);

        PermissionsRoles::create([
            'permission_id' => 5,
            'role_id' => 2
        ]);

        PermissionsRoles::create([
            'permission_id' => 8,
            'role_id' => 2
        ]);

        PermissionsRoles::create([
            'permission_id' => 9,
            'role_id' => 2
        ]);

        $this->command->info('Tabla de permisos-roles inicializada');
    }
}
