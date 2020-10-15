<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Dominio;
use App\Models\Opcion;

class LoadDataOpcionTipoFuncionarioResponsable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio_id = $dominio->getDominioXGrupo('tipo_funcionario')->id;

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Responsable Reporte';
      $opcion->valor_numerico = 1;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Responsable Reporte';
      $opcion->abreviatura = 'RR';
      $opcion->orden = 0;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $dominio = new Dominio();
      $dominio_id = $dominio->getDominioXGrupo('tipo_funcionario')->id;

      $opciones = Opcion::where('dominio_id', $dominio_id)->where('abreviatura','RR');
      $opciones->delete();

    }
}
