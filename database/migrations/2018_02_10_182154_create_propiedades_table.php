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
            $table->integer('id_proyecto')->unsigned();
            $table->foreign('id_proyecto')->references('id')->on('propiedades');
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
