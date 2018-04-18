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
        $proyecto->nombre = ('proyecto prueba');
        $proyecto->direccion = ('calle 123 # 45');
        $proyecto->numero_de_pisos = 3;
        $proyecto->numero_de_apartamentos = 10;
        $proyecto->save(); 
    }
}
