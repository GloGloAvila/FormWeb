<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\Opcion;

class Dominio extends Model
{

  use SoftDeletes;

  // Constantes para saber si el dominio es administrable
  const REGISTRO_ADMINISTRABLE = '1';
  const REGISTRO_NO_ADMINISTRABLE = '0';

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'dominios';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'nombre',
    'grupo',
    'descripcion',
    'administrable',
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

  // Función para saber si un dominio es administrable
  public function esAdministrable()
  {
    return $this->administrable == Dominio::REGISTRO_ADMINISTRABLE;
  }

  // Función para saber si un registro está activo
  public function estaActivo()
  {
    return $this->activo == Dominio::REGISTRO_ACTIVO;
  }

  public function getDominiosAdministrables()
  {
    return $this->where('administrable', Dominio::REGISTRO_ADMINISTRABLE)
    ->where('activo', Dominio::REGISTRO_ACTIVO)->get();
  }

  static public function getDominioXGrupo($grupo)
  {
    return Dominio::where('grupo', $grupo)->where('activo', Dominio::REGISTRO_ACTIVO)->first();
  }

  public function opciones()
  {
    return $this->hasMany(Opcion::class);
  }

}
