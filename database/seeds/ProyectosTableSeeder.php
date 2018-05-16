<?php

use Illuminate\Database\Seeder;
use App\Proyecto;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedProyectos();
        $this->command->info('Tabla de proyectos inicializada');
    }

    private function seedProyectos(){
        $proyecto = new Proyecto;
        $proyecto->nombre = ('VENTTO');
        $proyecto->direccion = ('Cr 4 # 18 - 22');
        $proyecto->numero_de_apartamentos = 646;
        $proyecto->save();
    }
}
