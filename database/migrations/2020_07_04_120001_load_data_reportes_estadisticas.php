<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuenteReportesEstadisticasController;

class LoadDataReportesEstadisticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $cargarFuente=new CargarFuenteReportesEstadisticasController();
      $cargarFuente->cargarFuente('2020-07-04-historico-estadisticas.csv');
    }
}
