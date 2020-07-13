<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Funcionario;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('prestador_id');
          $table->unsignedInteger('tipo_funcionario_id');
          $table->string('nombre');
          $table->string('apellido');
          $table->string('email')->unique();
          $table->string('password');
          $table->string('telefono')->nullable();
          $table->string('celular')->nullable();
          $table->boolean('activo')->default(Funcionario::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->rememberToken();
          $table->softDeletes()->nullable();

          $table->foreign('prestador_id')->references('id')->on('prestadores');
          $table->foreign('tipo_funcionario_id')->references('id')->on('opciones');

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
      Schema::dropIfExists('funcionarios');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
