<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Dominio;
use App\Models\Opcion;

class LoadDataOpcionTipoPrestador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      $dominio = new Dominio();
      $dominio_id = $dominio->getDominioXGrupo('tipo_prestador')->id;

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Agencia privada';
      $opcion->valor_numerico = 1;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Agencia privada';
      $opcion->abreviatura = 'AP';
      $opcion->orden = 0;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Bolsa de Empleo';
      $opcion->valor_numerico = 2;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Bolsa de Empleo';
      $opcion->abreviatura = 'BE';
      $opcion->orden = 0;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Otras Bolsas';
      $opcion->valor_numerico = 3;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Otras Bolsas';
      $opcion->abreviatura = 'OB';
      $opcion->orden = 0;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();      

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Agencia P??blica de Empleo de Ente Territorial';
      $opcion->valor_numerico = 4;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Agencia P??blica de Empleo de Ente Territorial';
      $opcion->abreviatura = 'APEET';
      $opcion->orden = 0;
      $opcion->editable = Opcion::REGISTRO_NO_EDITABLE;
      $opcion->borrable = Opcion::REGISTRO_NO_BORRABLE;
      $opcion->save();

      $opcion = new Opcion();
      $opcion->dominio_id = $dominio_id;
      $opcion->tiene_subopciones = Opcion::TIENE_SUBOPCIONES_FALSE;
      $opcion->valor_texto = 'Agencia de Gesti??n y Colocaci??n de Empleo de Caja de Compensaci??n Familiar';
      $opcion->valor_numerico = 5;
      $opcion->valor_booleano = Opcion::VALOR_BOOLEANO_FALSE;
      $opcion->descripcion = 'Agencia de Gesti??n y Colocaci??n de Empleo de Caja de Compensaci??n Familiar';
      $opcion->abreviatura = 'AGCECCF';
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
      $dominio_id = $dominio->getDominioXGrupo('tipo_prestador')->id;

      $opciones = Opcion::where('dominio_id', $dominio_id);
      $opciones->delete();
    }
}
