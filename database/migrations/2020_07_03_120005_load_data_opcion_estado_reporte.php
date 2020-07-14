<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Dominio;
use App\Models\Opcion;

class LoadDataOpcionEstadoReporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio_id = $dominio->getDominioXGrupo('estado_reporte')->id;

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Pendiente';
      $opcion->valor_numerico = 1;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Pendiente reporte mes';
      $opcion->abreviatura = 'P';
      $opcion->orden = 1;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Reportado';
      $opcion->valor_numerico = 2;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Reporte mensual diligenciado';
      $opcion->abreviatura = 'R';
      $opcion->orden = 2;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Sin reporte';
      $opcion->valor_numerico = 2;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Reporte mensual no diligenciado';
      $opcion->abreviatura = 'SR';
      $opcion->orden = 2;
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
      $dominio_id = $dominio->getDominioXGrupo('estado_reporte')->id;

      $opciones = Opcion::where('dominio_id', $dominio_id);
      $opciones->delete();

    }
}
