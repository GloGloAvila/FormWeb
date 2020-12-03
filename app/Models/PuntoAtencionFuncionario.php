<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\PuntoAtencion;
use App\Models\Funcionario;

class PuntoAtencionFuncionario extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'punto_atencion_tiene_funcionarios';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'punto_atencion_id',
    'funcionario_id',
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
    return $this->activo == PuntoAtencionFuncionario::REGISTRO_ACTIVO;
  }

  public function puntoAtencion()
  {
    return $this->belongsTo(PuntoAtencion::class);
  }

  public function funcionario()
  {
    return $this->belongsTo(Funcionario::class);
  }

}
