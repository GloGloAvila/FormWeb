<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Departamento;

class CreateDepartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
          $table->increments('id');
          $table->string('codigo');
          $table->string('divipola');
          $table->string('nombre');
          $table->boolean('activo')->default(Departamento::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();
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
      Schema::dropIfExists('departamentos');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
