<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\PuntoAtencion;

class CreatePuntosAtencionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos_atencion', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('migracion_id')->nullable();
          $table->unsignedInteger('prestador_id');

          $table->string('departamento_id')->nullable();
          $table->string('municipio_id')->nullable();
          $table->string('nombre');
          $table->string('sitio_web')->nullable();
          $table->string('correo_electronico')->nullable();
          $table->string('direccion')->nullable();
          $table->string('fecha_registro')->nullable();

          $table->boolean('activo')->default(PuntoAtencion::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('prestador_id')->references('id')->on('prestadores');
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
      Schema::dropIfExists('puntos_atencion');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
