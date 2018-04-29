<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('valor', 14, 2);
            $table->string('metodo_pago',20);
            $table->boolean('estado');
            $table->integer('propiedad')->unsigned();
            $table->foreign('propiedad')->references('id')->on('propiedades');
            $table->integer('comprador')->unsigned();
            $table->foreign('comprador')->references('id')->on('users');
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
        Schema::dropIfExists('ventas');
    }
}
