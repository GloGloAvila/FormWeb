<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\Opcion;

class Funcionario extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'funcionarios';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tipo_funcionario_id',
    'nombre',
    'apellido',
    'correo_electronico',
    'password',
    'telefono',
    'celular',
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
    return $this->activo == Funcionario::REGISTRO_ACTIVO;
  }

  // Función para saber si un registro está activo
  public static function correoExistente($correo)
  {
    return Funcionario::where('email', $correo)->count() > 0;
  }

  public function tipoFuncionario()
  {
    return $this->belongsTo(Opcion::class, 'tipo_funcionario_id');
  }

}
