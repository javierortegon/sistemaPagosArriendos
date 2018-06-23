<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->integer('tipo_propiedad')->unsigned();
            $table->foreign('tipo_propiedad')->references('id')->on('tipos_propiedad');
            $table->integer('propiedad')->unsigned()->nullable();
            $table->foreign('propiedad')->references('id')->on('propiedades');
            $table->decimal('valor_primer_pago', 14, 2);
            $table->integer('numero_de_cuotas'); // excluyendo la primera
            $table->integer('usuario_que_registra')->unsigned();
            $table->foreign('usuario_que_registra')->references('id')->on('users');
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
        Schema::dropIfExists('presupuestos');
    }
}
