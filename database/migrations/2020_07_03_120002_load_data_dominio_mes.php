<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Dominio;

class LoadDataDominioMes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio->nombre = 'Meses';
      $dominio->grupo = 'mes';
      $dominio->descripcion = 'Dominio para administrar los meses del año.';
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
      $dominio = Dominio::where('grupo', 'mes');
      $dominio->delete();        
    }
}
