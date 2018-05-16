<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('event_name');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('venta')->unsigned();
            $table->foreign('venta')->references('id')->on('ventas');
            $table->integer('cliente')->unsigned();
            $table->foreign('cliente')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
}
