<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Dominio;

class LoadDataDominioTipoFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio->nombre = 'Tipos de Funcionario';
      $dominio->grupo = 'tipo_funcionario';
      $dominio->descripcion = 'Dominio para administrar los tipos de funcionarios de los prestadores.';
      $dominio->administrable = Dominio::REGISTRO_NO_ADMINISTRABLE;
      $dominio->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $dominio = Dominio::where('grupo', 'tipo_funcionario');
      $dominio->delete();        
    }
}
