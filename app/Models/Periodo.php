<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\Vigencia;

class Periodo extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'periodos';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'vigencia_id',
    'mes_id',
    'estado_reporte_id',
    'nombre',
    'fecha_inicio',
    'fecha_fin',
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
    return $this->activo == Periodo::REGISTRO_ACTIVO;
  }

  public function vigencia()
  {
    return $this->belongsTo(Vigencia::class);
  }

  public function reportes()
  {
    return $this->hasMany(Reporte::class);
  }

}
