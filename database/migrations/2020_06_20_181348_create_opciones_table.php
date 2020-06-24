<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Opcion;

class CreateOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('dominio_id');
          $table->unsignedInteger('opcion_id')->nullable();
          $table->boolean('tiene_subopciones')->default(Opcion::TIENE_SUBOPCIONES_FALSE);
          $table->string('valor_texto');
          $table->integer('valor_numerico');
          $table->boolean('valor_booleano')->default(Opcion::VALOR_BOOLEANO_FALSE);
          $table->text('descripcion');
          $table->string('abreviatura');
          $table->integer('orden');
          $table->boolean('editable')->default(Opcion::REGISTRO_EDITABLE);
          $table->boolean('borrable')->default(Opcion::REGISTRO_BORRABLE);
          $table->boolean('activo')->default(Opcion::REGISTRO_ACTIVO);
          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('dominio_id')->references('id')->on('dominios');
          $table->foreign('opcion_id')->references('id')->on('opciones');
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
      Schema::dropIfExists('opciones');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
