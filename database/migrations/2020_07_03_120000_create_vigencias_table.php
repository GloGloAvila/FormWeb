<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Vigencia;

class CreateVigenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vigencias', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre')->unique();
          $table->boolean('activo')->default(Vigencia::REGISTRO_ACTIVO);

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
      Schema::dropIfExists('vigencias');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
