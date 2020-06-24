<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuentePuntosAtencionController;

class LoadDataPuntosAtencion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $cargarFuente=new CargarFuentePuntosAtencionController();
      $cargarFuente->cargarFuente('puntos_atencion.csv');
    }

   
}
