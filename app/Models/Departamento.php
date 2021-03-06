<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Departamento extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'departamentos';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'codigo',
    'divipola',
    'nombre',
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
    return $this->activo == Departamento::REGISTRO_ACTIVO;
  }

  public function municipios()
  {
    return $this->hasMany(Municipio::class);
  }

  //Función para obtener el departamento por código
  public static function obtenerDepartamentoXCodigo ($codigo) {

    $departamento = Departamento::where(
      [
        'codigo' => $codigo
      ]
    )->first();

    return isset($departamento) ? $departamento : null;
  }


}
