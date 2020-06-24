<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Prestador;

class CreatePrestadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('migracion_id')->nullable();
          $table->unsignedInteger('tipo_prestador_id');
          $table->string('nombre');
          $table->boolean('activo')->default(Prestador::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('tipo_prestador_id')->references('id')->on('opciones');
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
      Schema::dropIfExists('prestadores');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
