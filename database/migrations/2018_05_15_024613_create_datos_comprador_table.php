<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosCompradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_comprador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('direccion_correspondencia');
            $table->string('barrio');
            $table->string('ciudad');
            $table->string('estado_civil');
            $table->string('tipo_representacion');
            $table->string('ocupacion');
            $table->string('cargo');
            $table->string('empresa');
            $table->string('telefono');
            $table->string('tipo_vinculacion');
            $table->string('tipo_contrato');
            $table->string('encuesta');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
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
        Schema::dropIfExists('datos_comprador');
    }
}
