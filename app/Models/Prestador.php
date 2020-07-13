<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\PuntoAtencion;
use App\Models\Opcion;

class Prestador extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'prestadores';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'migracion_id',
    'nombre',
    'tipo_prestador_id',
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

  
  // Función para saber si un registro está activo
  public function estaActivo()
  {
    return $this->activo == Prestador::REGISTRO_ACTIVO;
  }

  static public function getPrestadorXMigracionId($migracionId)
  {
    return Prestador::where('migracion_id', $migracionId)->where('activo', Opcion::REGISTRO_ACTIVO)->first();
  }

  public function tipoPrestador()
  {
    return $this->belongsTo(Opcion::class);
  }

  public function puntosAtencion()
  {
    return $this->hasMany(PuntoAtencion::class);
  }

}
