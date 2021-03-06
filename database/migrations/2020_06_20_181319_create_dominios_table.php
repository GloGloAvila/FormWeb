<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Dominio;

class CreateDominiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dominios', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre');
          $table->string('grupo');
          $table->string('descripcion', 200);
          $table->boolean('administrable')->default(Dominio::REGISTRO_ADMINISTRABLE);
          $table->boolean('activo')->default(Dominio::REGISTRO_ACTIVO);
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
      Schema::dropIfExists('dominios');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
