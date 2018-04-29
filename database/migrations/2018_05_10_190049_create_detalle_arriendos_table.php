<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleArriendosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_arriendos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('propiedad_id')->unsigned();
            $table->foreign('propiedad_id')->references('id')->on('propiedades');
            $table->integer('valorArriendo');
            $table->date('fecha_factura');
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
        Schema::dropIfExists('detalle_arriendos');
    }
}
