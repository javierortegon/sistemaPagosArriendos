<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCuotaInicialToTiposPropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipos_propiedad', function (Blueprint $table) {
            //
            $table->decimal('cuota_inicial', 14, 2)->after('valor');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos_propiedad', function (Blueprint $table) {
            //
            $table->dropColumn('cuota_inicial');            
        });
    }
}
