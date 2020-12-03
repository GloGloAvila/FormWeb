<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPuntoAtencionTieneFuncionariosAddColumnActivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('punto_atencion_tiene_funcionarios', function (Blueprint $table) {
            $table->boolean('activo')->default(1)->after('funcionario_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('punto_atencion_tiene_funcionarios', function (Blueprint $table) {
            $table->dropColumn('activo');
        });

    }
}
