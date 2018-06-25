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
        $tipoPropiedad->nombre = "Torre 1";
        $tipoPropiedad->descripcion = "16 Pisos";
        $tipoPropiedad->valor = 149950000;
        $tipoPropiedad->proyecto = 1;
        $tipoPropiedad->cuota_inicial = 36000000;
        $tipoPropiedad->save();

        $tipoPropiedad2 = new TiposPropiedad;
        $tipoPropiedad2->nombre = "Torre 2";
        $tipoPropiedad2->descripcion = "32 Pisos";
        $tipoPropiedad2->valor = 166150000;
        $tipoPropiedad2->proyecto = 1;
        $tipoPropiedad2->cuota_inicial = 36000000;
        $tipoPropiedad2->save();
    }
}
