<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos para proyectos 1,4

        Permission::create([
            'name' => 'Registrar Proyectos',
            'slug' => 'proyecto.registro',
            'description' => 'Permiso para registrar proyecto.'
        ]);

        Permission::create([
            'name' => 'Consultar Proyectos',
            'slug' => 'proyectos.consultar',
            'description' => 'Permiso para consultar proyectos.'
        ]);

        Permission::create([
            'name' => 'Editar Proyectos',
            'slug' => 'proyectos.edit',
            'description' => 'Permiso para editar proyectos.'
        ]);

        Permission::create([
            'name' => 'Detalle Proyectos',
            'slug' => 'proyectos.detalle',
            'description' => 'Permiso para ver los detalles del proyectos.'
        ]);

        //Permisos para tipos de propiedad 5,7
        Permission::create([
            'name' => 'Consultar Tipos Propiedad',
            'slug' => 'tiposPropiedad.consultar',
            'description' => 'Permiso para ver los tipos de propiedad del proyectos.'
        ]);

        Permission::create([
            'name' => 'Editar Tipos Propiedad',
            'slug' => 'tiposPropiedad.edit',
            'description' => 'Permiso para editar los tipos de propiedad del proyectos.'
        ]);

        Permission::create([
            'name' => 'Registrar Tipos Propiedad',
            'slug' => 'tiposPropiedad.registro',
            'description' => 'Permiso para registrar los tipos de propiedad del proyectos.'
        ]);

        //permisos para las propiedades 8,9
        Permission::create([
            'name' => 'Registrar Propiedad',
            'slug' => 'registroPropiedad',
            'description' => 'Permiso para registrar propiedades.'
        ]);
        
        Permission::create([
            'name' => 'Consultar Propiedades',
            'slug' => 'verPropiedades',
            'description' => 'Permiso para consultar propiedades.'
        ]);

        $this->command->info('Tabla de permisos inicializada');
    }
}
