<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

use App\Models\Dominio;

class LoadDataDominioEstadoReporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio->nombre = 'Estados reporte';
      $dominio->grupo = 'estado_reporte';
      $dominio->descripcion = 'Dominio para administrar los estados del reporte mensual.';
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
      $dominio = Dominio::where('grupo', 'estado_reporte');
      $dominio->delete();        
    }
}