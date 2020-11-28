<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterReporteDropForeingIndexFuncionarioIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('reportes', function (Blueprint $table) {
            $table->dropForeign('reportes_funcionario_id_foreign');
            $table->dropIndex('reportes_funcionario_id_foreign');
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
            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
        });

    }
}
