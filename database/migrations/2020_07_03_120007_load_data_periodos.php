<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Vigencia;
use App\Models\Periodo;
use App\Models\Dominio;
use App\Models\Opcion;

class LoadDataPeriodos extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    $dominio = new Dominio();
    $dominio_id = $dominio->getDominioXGrupo('mes')->id;

    $vigencias = Vigencia::where('activo', 1)->get();
    $meses = Opcion::where('dominio_id', $dominio_id)->get();

    foreach ($vigencias as $vigencia) {

      foreach ($meses as $mes) {

        // Calculando estado de los periodos
        $estado = 'Pendiente';
        if ($vigencia->nombre === '2018' &&  intval($mes->descripcion) < 12) {
          $estado = 'No aplica';
        } else {
          $estado = 'Incompleto';
          if ($vigencia->nombre === '2020' &&  intval($mes->descripcion) > 10) {
            $estado = 'Pendiente';
          } else if ($vigencia->nombre === '2020' && (intval($mes->descripcion) > 10 && intval($mes->descripcion) <= 10)) {
            $estado = 'Sin reporte';
          }
        }

        $periodo = new Periodo();
        $periodo->vigencia_id = $vigencia->id;
        $periodo->mes_id = $mes->id;
        $periodo->estado_reporte_id = Opcion::getOpcionXGrupoXValorTexto('estado_reporte', $estado)->id;
        $periodo->fecha_inicio = (Periodo::calcularMesSiguiente($mes->descripcion) !== '01' ? $vigencia->nombre : ($vigencia->nombre + 1)) . '-' . Periodo::calcularMesSiguiente($mes->descripcion) . '-01';
        $periodo->fecha_fin = (Periodo::calcularMesSiguiente($mes->descripcion) !== '01' ? $vigencia->nombre : ($vigencia->nombre + 1)) . '-' . Periodo::calcularMesSiguiente($mes->descripcion) . '-15';
        $periodo->save();
      }
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Periodo::truncate();
  }

}
