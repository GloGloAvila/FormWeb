<?php

use App\Models\Reporte;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnResponsableTypeDefaultValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Reporte::where('responsable_type', '=', 'AppModelsFuncionario')->update(['responsable_type' => 'App\Models\Funcionario']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
