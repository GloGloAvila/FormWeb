<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuenteDepartamentosController;

class LoadDataDepartamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $cargarFuente=new CargarFuenteDepartamentosController();
      $cargarFuente->cargarFuente('2020-06-21-departamentos.csv');
    }

   
}
