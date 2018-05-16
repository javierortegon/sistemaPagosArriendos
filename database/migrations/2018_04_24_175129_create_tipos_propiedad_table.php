<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposPropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_propiedad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 20);
            $table->decimal('valor', 14, 2);
            $table->text('descripcion');
            $table->integer('proyecto')->unsigned();
            $table->foreign('proyecto')->references('id')->on('proyectos');
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
        Schema::dropIfExists('tipos_propiedad');
    }
}
