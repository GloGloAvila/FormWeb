<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReporteAddColumnsExteriorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('reportes', function (Blueprint $table) {
            $table->integer('hojas_vida_remitidas_exterior_total')->default(0)->after('transnacionales');
            $table->integer('hojas_vida_remitidas_exterior_hombres')->default(0)->after('hojas_vida_remitidas_exterior_total');
            $table->integer('hojas_vida_remitidas_exterior_mujeres')->default(0)->after('hojas_vida_remitidas_exterior_hombres');
            $table->integer('personas_colocadas_exterior_total')->default(0)->after('hojas_vida_remitidas_exterior_mujeres');
            $table->integer('personas_colocadas_exterior_hombres')->default(0)->after('personas_colocadas_exterior_total');
            $table->integer('personas_colocadas_exterior_mujeres')->default(0)->after('personas_colocadas_exterior_hombres');
            $table->integer('empleadores_registrados_exterior')->default(0)->after('personas_colocadas_exterior_mujeres');
            $table->integer('vacantes_registradas_exterior')->default(0)->after('empleadores_registrados_exterior');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->dropColumn('hojas_vida_remitidas_exterior_total');
            $table->dropColumn('hojas_vida_remitidas_exterior_hombres');
            $table->dropColumn('hojas_vida_remitidas_exterior_mujeres');
            $table->dropColumn('personas_colocadas_exterior_total');
            $table->dropColumn('personas_colocadas_exterior_hombres');
            $table->dropColumn('personas_colocadas_exterior_mujeres');
            $table->dropColumn('empleadores_registrados_exterior');
            $table->dropColumn('vacantes_registradas_exterior');
        });

    }
}
