<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Funcionario;

class CreatePuntoAtencionTieneFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punto_atencion_tiene_funcionarios', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('punto_atencion_id');
          $table->unsignedInteger('funcionario_id');

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('punto_atencion_id')->references('id')->on('puntos_atencion');
          $table->foreign('funcionario_id')->references('id')->on('funcionarios');

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
      Schema::dropIfExists('punto_atencion_tiene_funcionarios');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
