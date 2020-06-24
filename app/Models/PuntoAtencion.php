<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\Prestador;

class PuntoAtencion extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'puntos_atencion';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  //ID, Nombre, ID_Prestador, ID_Departamento, ID_Municipio, Mail_Punto_Atencion, Direccion_Punto_Atencion,
  //Nombre_Contacto, Apellido_Contacto, Email_Contacto, Telefono_Contacto, Celular_Contacto, Autorizacion,
  //pagina_web, fecha_registro,  observaciones, apellido, email, telefono, celular, nombre_dir,
  //apellidos_dir, email_dir, palabra_clave

  protected $fillable = [
    'migracion_id',
    'prestador_id',
    'departamento_id',
    'municipio_id',
    'nombre',
    'correo',
    'direccion',
    'nombre_contacto',
    'apellido_contacto',
    'correo_contacto',
    'telefono_contacto',
    'celular_contacto',
    'autorizacion',
    'pagina_web',
    'fecha_registro',
    'observaciones',
    'nombre_representante',
    'apellido_representante',
    'correo_representante',
    'telefono_representante',
    'celular_representante',
    'palabra_clave',
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
    return $this->activo == PuntoAtencion::REGISTRO_ACTIVO;
  }

  public function prestador()
  {
    return $this->hasMany(Prestador::class);
  }

}
