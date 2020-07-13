<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Municipio;

class CreateMunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('departamento_id');
          $table->string('codigo_departamento');
          $table->string('divipola');
          $table->string('nombre');
          $table->boolean('activo')->default(Municipio::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('departamento_id')->references('id')->on('departamentos');

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
      Schema::dropIfExists('municipios');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
