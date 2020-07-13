<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuenteFuncionariosController;

class LoadDataFuncionarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $cargarFuente=new CargarFuenteFuncionariosController();
      $cargarFuente->cargarFuente('2020-07-02-funcionarios.csv');
    }
}
