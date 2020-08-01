<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Periodo;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('vigencia_id');
          $table->unsignedInteger('mes_id');
          $table->unsignedInteger('estado_reporte_id');
          $table->date('fecha_inicio')->nullable();
          $table->date('fecha_fin')->nullable();
          $table->boolean('activo')->default(Periodo::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('vigencia_id')->references('id')->on('vigencias');
          $table->foreign('mes_id')->references('id')->on('opciones');
          $table->foreign('estado_reporte_id')->references('id')->on('opciones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      Schema::dropIfExists('periodos');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
