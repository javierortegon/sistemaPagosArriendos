<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarterasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carteras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta')->unsigned();
            $table->foreign('venta')->references('id')->on('ventas');
            $table->integer('numero_cuota');
            $table->date('fecha_pago');
            $table->float('valor', 10, 2);
            $table->boolean('confirmado');
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
        Schema::dropIfExists('carteras');
    }
}
