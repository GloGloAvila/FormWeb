<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Dominio;
use App\Models\Opcion;

class LoadDataOpcionMes extends Migration
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

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Enero';
      $opcion->valor_numerico = 1;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '01';
      $opcion->abreviatura = 'ENE';
      $opcion->orden = 1;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Febrero';
      $opcion->valor_numerico = 2;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '02';
      $opcion->abreviatura = 'FEB';
      $opcion->orden = 2;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Marzo';
      $opcion->valor_numerico = 3;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '03';
      $opcion->abreviatura = 'MAR';
      $opcion->orden = 3;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Abril';
      $opcion->valor_numerico = 4;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '04';
      $opcion->abreviatura = 'FEB';
      $opcion->orden = 4;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Mayo';
      $opcion->valor_numerico = 5;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '05';
      $opcion->abreviatura = 'MAY';
      $opcion->orden = 5;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Junio';
      $opcion->valor_numerico = 6;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '06';
      $opcion->abreviatura = 'JUN';
      $opcion->orden = 6;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Julio';
      $opcion->valor_numerico = 7;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '07';
      $opcion->abreviatura = 'JUL';
      $opcion->orden = 7;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Agosto';
      $opcion->valor_numerico = 8;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '08';
      $opcion->abreviatura = 'AGO';
      $opcion->orden = 8;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Septiembre';
      $opcion->valor_numerico = 9;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '09';
      $opcion->abreviatura = 'SEP';
      $opcion->orden = 9;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Octubre';
      $opcion->valor_numerico = 10;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '10';
      $opcion->abreviatura = 'OCT';
      $opcion->orden = 10;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Noviembre';
      $opcion->valor_numerico = 11;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '11';
      $opcion->abreviatura = 'NOV';
      $opcion->orden = 11;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Diciembre';
      $opcion->valor_numerico = 12;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = '12';
      $opcion->abreviatura = 'DIC';
      $opcion->orden = 12;
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
      $dominio_id = $dominio->getDominioXGrupo('mes')->id;

      $opciones = Opcion::where('dominio_id', $dominio_id);
      $opciones->delete();

    }
}
