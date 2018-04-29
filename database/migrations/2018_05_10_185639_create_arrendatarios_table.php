<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrendatariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrendatarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arrendatario_id_usuario')->unsigned();
            $table->foreign('arrendatario_id_usuario')->references('id')->on('users');
            $table->integer('propiedad_id')->unsigned();
            $table->foreign('propiedad_id')->references('id')->on('propiedades');
            $table->date('fecha_factura')->nullable();
            $table->decimal('valor_arriendo', 8, 2)->nullable();
            $table->boolean('estado')->nullable();
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
        Schema::dropIfExists('arrendatarios');
    }
}
