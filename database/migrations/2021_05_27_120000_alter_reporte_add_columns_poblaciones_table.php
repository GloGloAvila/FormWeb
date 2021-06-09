<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReporteAddColumnsPoblacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('reportes', function (Blueprint $table) {
            $table->integer('colocados_jovenes_hombres')->default(0)->after('colocados_jovenes');
            $table->integer('colocados_jovenes_mujeres')->default(0)->after('colocados_jovenes_hombres');

            $table->integer('colocados_discapacidad_hombres')->default(0)->after('colocados_discapacidad');
            $table->integer('colocados_discapacidad_mujeres')->default(0)->after('colocados_discapacidad_hombres');
            
            $table->integer('colocados_victimas_hombres')->default(0)->after('colocados_victimas');
            $table->integer('colocados_victimas_mujeres')->default(0)->after('colocados_victimas_hombres');

            $table->integer('personas_inscritas_hombres_victimas')->default(0)->after('personas_inscritas_mujeres');
            $table->integer('personas_inscritas_mujeres_victimas')->default(0)->after('personas_inscritas_hombres_victimas');

            $table->integer('personas_inscritas_hombres_jovenes')->default(0)->after('personas_inscritas_mujeres_victimas');
            $table->integer('personas_inscritas_mujeres_jovenes')->default(0)->after('personas_inscritas_hombres_jovenes');

            $table->integer('personas_inscritas_hombres_PcD')->default(0)->after('personas_inscritas_mujeres_jovenes');
            $table->integer('personas_inscritas_mujeres_PcD')->default(0)->after('personas_inscritas_hombres_PcD');

            $table->integer('personas_inscritas_hombres_Migrantes')->default(0)->after('personas_inscritas_mujeres_PcD');
            $table->integer('personas_inscritas_mujeres_Migrantes')->default(0)->after('personas_inscritas_hombres_Migrantes');

            $table->integer('personas_inscritas_hombres_Grupo')->default(0)->after('personas_inscritas_mujeres_Migrantes');
            $table->integer('personas_inscritas_mujeres_Grupo')->default(0)->after('personas_inscritas_hombres_Grupo');


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
            $table->dropColumn('colocados_jovenes_hombres');
            $table->dropColumn('colocados_jovenes_mujeres');
            $table->dropColumn('colocados_discapacidad_hombres');
            $table->dropColumn('colocados_discapacidad_mujeres');
            $table->dropColumn('colocados_victimas_hombres');
            $table->dropColumn('colocados_victimas_mujeres');

            $table->dropColumn('personas_inscritas_hombres_victimas');
            $table->dropColumn('personas_inscritas_mujeres_victimas');
            $table->dropColumn('personas_inscritas_hombres_jovenes');
            $table->dropColumn('personas_inscritas_mujeres_jovenes');
            $table->dropColumn('personas_inscritas_hombres_PcD');
            $table->dropColumn('personas_inscritas_mujeres_PcD');

            $table->dropColumn('personas_inscritas_hombres_Migrantes');
            $table->dropColumn('personas_inscritas_mujeres_Migrantes');
            $table->dropColumn('personas_inscritas_hombres_Grupo');
            $table->dropColumn('personas_inscritas_mujeres_Grupo');
            
            
        });

    }
}
