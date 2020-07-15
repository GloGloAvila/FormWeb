<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Vigencia;

class LoadDataVigencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $vigencia = new Vigencia();
      $vigencia->nombre = '2018';
      $vigencia->save();

      $vigencia = new Vigencia();
      $vigencia->nombre = '2019';
      $vigencia->save();

      $vigencia = new Vigencia();
      $vigencia->nombre = '2020';
      $vigencia->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Vigencia::truncate();
    }
}
