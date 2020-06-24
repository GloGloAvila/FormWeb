<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuentePrestadoresController;

class LoadDataPrestadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $cargarFuente=new CargarFuentePrestadoresController();
      $cargarFuente->cargarFuente('prestadores.csv');
    }

   
}
