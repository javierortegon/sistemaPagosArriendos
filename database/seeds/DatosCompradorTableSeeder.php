<?php

use Illuminate\Database\Seeder;
use App\DatosComprador;

class DatosCompradorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DatosComprador::create([
            'direccion_correspondencia' => 'calle 123',
            'barrio' => 'centro',
            'ciudad' => 'bogota',
            'estado_civil' => 'soltero',
            'tipo_representacion' => 'natural',
            'ocupacion' => 'empleado',
            'cargo' => 'gerente',
            'empresa' => 'bluetower',
            'telefono' => '123987',
            'tipo_vinculacion' => 'fijo',
            'tipo_contrato' => 'fijo',
            'encuesta' => 'tv',
            'id_usuario' => 3
        ]);

        $this->command->info('Tabla de datos comprador inicializada');
    }
}
