<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReporteAddColumnsSeparacionCamposHvRemitidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('reportes', function (Blueprint $table) {
            $table->integer('remisiones_a_empleadores_total_a')->default(0)->after('remisiones_a_empleadores_mujeres');
            $table->integer('remisiones_a_empleadores_hombres_a')->default(0)->after('remisiones_a_empleadores_total_a');
            $table->integer('remisiones_a_empleadores_mujeres_a')->default(0)->after('remisiones_a_empleadores_hombres_a');

            $table->integer('remisiones_a_empleadores_total_bc')->default(0)->after('remisiones_a_empleadores_mujeres_a');
            $table->integer('remisiones_a_empleadores_hombres_bc')->default(0)->after('remisiones_a_empleadores_total_bc');
            $table->integer('remisiones_a_empleadores_mujeres_bc')->default(0)->after('remisiones_a_empleadores_hombres_bc');

        });

    }

    /**
     * Reverse the migrationsremisiones_a_empleadores_mujeres.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportes', function (Blueprint $table) {
            $table->dropColumn('remisiones_a_empleadores_total_a');
            $table->dropColumn('remisiones_a_empleadores_hombres_a');
            $table->dropColumn('remisiones_a_empleadores_mujeres_a');
            $table->dropColumn('remisiones_a_empleadores_total_bc');
            $table->dropColumn('remisiones_a_empleadores_hombres_bc');
            $table->dropColumn('remisiones_a_empleadores_mujeres_bc');
        });

    }
}
