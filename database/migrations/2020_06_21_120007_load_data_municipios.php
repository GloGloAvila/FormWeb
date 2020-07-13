<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\CargaFuentes\CargarFuenteMunicipiosController;

class LoadDataMunicipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $cargarFuente=new CargarFuenteMunicipiosController();
      $cargarFuente->cargarFuente('2020-06-21-municipios.csv');
    }

   
}
