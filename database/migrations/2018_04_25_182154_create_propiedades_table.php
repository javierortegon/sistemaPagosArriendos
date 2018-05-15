<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropiedadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('direccion',50);
            $table->string('descripcion',140);
            $table->string('nombre',150);
            $table->string('codigo',20);
            $table->boolean('estado');
            $table->string('numero_piso',3);
            $table->string('area_aproximada',20);
            $table->string('area_privada_aprox',20);
            $table->integer('id_proyecto')->unsigned();
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
            $table->integer('id_tipoPropiedad')->unsigned();
            $table->foreign('id_tipoPropiedad')->references('id')->on('tipos_propiedad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propiedades');
    }
}
