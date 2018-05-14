<?php

use Illuminate\Database\Seeder;
use App\TiposPropiedad;

class TiposPropiedadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        self::seedTiposPropiedad();
		$this->command->info('Tabla tipos proyecto inicializada con datos!');
    }

    public function seedTiposPropiedad(){
        $tipoPropiedad = new TiposPropiedad;
        $tipoPropiedad->nombre = "Tipo 1";
        $tipoPropiedad->descripcion = "30 metros cuadrados";
        $tipoPropiedad->valor = 150000000;
        $tipoPropiedad->proyecto = 1;
        $tipoPropiedad->save();
    }
}
