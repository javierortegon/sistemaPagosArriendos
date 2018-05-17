<?php

use Illuminate\Database\Seeder;
use App\Propiedad;

class PropiedadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedPropiedades();
		$this->command->info('Tabla propiedades inicializada con datos!');
    }

    private function seedPropiedades(){
		$propiedad = new Propiedad;
        $propiedad->direccion = ('Calle 123');
        $propiedad->descripcion = ('apartemento ');
        $propiedad->codigo = ('cc01');
        $propiedad->nombre = ('casa 123');
        $propiedad->estado = (1);
        $propiedad->numero_piso = ('3');
        $propiedad->area_aproximada = ('100');
        $propiedad->area_privada_aprox = ('100');
        $propiedad->id_proyecto = 1;
        $propiedad->id_tipoPropiedad = 1;
		$propiedad->save();
	}
}
