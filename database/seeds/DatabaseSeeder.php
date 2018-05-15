<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProyectosTableSeeder::class);
        $this->call(TiposPropiedadTableSeeder::class);
        $this->call(PropiedadesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RolesUsersTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(DatosCompradorTableSeeder::class);
        //$this->call(RolesUsuariosTableSeeder::class);
    }
}
