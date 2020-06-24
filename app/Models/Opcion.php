<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Log;

use App\Models\Dominio;

class Opcion extends Model
{

  use SoftDeletes;

  // Constantes para saber si la opcion tiene subopciones
  const TIENE_SUBOPCIONES_TRUE = '1';
  const TIENE_SUBOPCIONES_FALSE = '0';

  // Constantes para saber el valor booleano del registro
  const VALOR_BOOLEANO_TRUE = '1';
  const VALOR_BOOLEANO_FALSE = '0';

  // Constantes para saber si la opcion es editable
  const REGISTRO_EDITABLE = '1';
  const REGISTRO_NO_EDITABLE = '0';

  // Constantes para saber si la opcion se puede eliminar
  const REGISTRO_BORRABLE = '1';
  const REGISTRO_NO_BORRABLE = '0';

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'opciones';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'dominio_id',
    'valor_texto',
    'valor_numerico',
    'valor_booleano',
    'descripcion',
    'abreviatura',
    'orden',
    'activo'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  // Función para saber el valor booleano
  public function tieneSubopciones()
  {
    return $this->tiene_subopciones == Opcion::TIENE_SUBOPCIONES_TRUE;
  }

  // Función para saber el valor booleano
  public function esVerdadero()
  {
    return $this->valor_booleano == Opcion::VALOR_BOOLEANO_TRUE;
  }

  // Función para saber si una opcion es editable
  public function esEditable()
  {
    return $this->editable == Opcion::REGISTRO_EDITABLE;
  }

  // Función para saber si una opcion se puede eliminar
  public function esBorrable()
  {
    return $this->borrable == Opcion::REGISTRO_BORRABLE;
  }

  // Función para saber si un registro está activo
  public function estaActivo()
  {
    return $this->activo == Opcion::REGISTRO_ACTIVO;
  }

  static public function getOpcionXGrupoXAbreviatura($grupo, $abreviatura)
  {
   // LOG::info($grupo.' '.$abreviatura);
    $dominio = new Dominio();
    return $dominio->getDominioXGrupo($grupo)->opciones()->where('abreviatura', $abreviatura)->where('activo', Opcion::REGISTRO_ACTIVO)->first();
  }

  public function getOpcionXID($id)
  {
    return $this->where('id', $id)->where('activo', Opcion::REGISTRO_ACTIVO)->first();
  }

  public function getOpcionesXDominio()
  {
    return $this->where('opcion_id', null)->where('activo', Opcion::REGISTRO_ACTIVO)->get();
  }

  public function getSubOpcionesXDominio($id)
  {
    return $this->where('opcion_id', $id)->where('activo', Opcion::REGISTRO_ACTIVO)->get();
  }

  public function dominio()
  {
    return $this->belongsTo(Dominio::class);
  }

  public function opcion()
  {
    return $this->belongsTo(Opcion::class);
  }


}
