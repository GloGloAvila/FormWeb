<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\PuntoAtencion;
use App\Models\Funcionario;
use App\User;
use App\Models\Periodo;

class Reporte extends Model
{

  use SoftDeletes;

  // Constantes para saber si el registro está activo
  const REGISTRO_ACTIVO = '1';
  const REGISTRO_INACTIVO = '0';

  protected $table = 'reportes';
  protected $dates = ['deleted_at'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'punto_atencion_id',
    'responsable_id',
    'responsable_type',
    'periodo_id',
    'personas_inscritas_total',
    'personas_inscritas_hombres',
    'personas_inscritas_mujeres',
    'remisiones_a_empleadores_total',
    'remisiones_a_empleadores_hombres',
    'remisiones_a_empleadores_mujeres',
    'colocados_total',
    'colocados_hombres',
    'colocados_mujeres',
    'colocados_victimas',
    'colocados_jovenes',
    'colocados_discapacidad',
    'empleadores_inscritos_total',
    'vacantes_registradas_total',
    'vacantes_registradas_contrato_laboral',
    'vacantes_registradas_prestacion',
    'remitidas_gestion_empleo_total',
    'remitidas_entrevista_orientacion',
    'remitidas_talleres_orientacion',
    'personas_atendidas',
    'personas_atendidas_hombres',
    'personas_atendidas_mujeres',
    'personas_atendidas_en_talleres',
    'personas_atendidas_en_talleres_hombres',
    'personas_atendidas_en_talleres_mujeres',
    'remitidas_formacion',
    'remitidas_formacion_hombres',
    'remitidas_formacion_competencias_hombres',
    'remitidas_formacion_tic_hombres',
    'remitidas_formacion_alfabetizacion_hombres',
    'remitidas_formacion_entrenamiento_hombres',
    'remitidas_formacion_tecnico_hombres',
    'remitidas_formacion_mujeres',
    'remitidas_formacion_competencias_mujeres',
    'remitidas_formacion_tic_mujeres',
    'remitidas_formacion_alfabetizacion_mujeres',
    'remitidas_formacion_entrenamiento_mujeres',
    'remitidas_formacion_tecnico_mujeres',
    'culminaron_formacion',
    'culminaron_formacion_hombres',
    'culminaron_formacion_competencias_hombres',
    'culminaron_formacion_tic_hombres',
    'culminaron_formacion_alfabetizacion_hombres',
    'culminaron_formacion_entrenamiento_hombres',
    'culminaron_formacion_tecnico_hombres',
    'culminaron_formacion_mujeres',
    'culminaron_formacion_competencias_mujeres',
    'culminaron_formacion_tic_mujeres',
    'culminaron_formacion_alfabetizacion_mujeres',
    'culminaron_formacion_entrenamiento_mujeres',
    'culminaron_formacion_tecnico_mujeres',
    'remitidas_talleres_emprendimiento',
    'remitidas_servicios_complementarios',
    'talleres_realizados',
    'remitidas_programas_emprendimiento',
    'remitidas_programas_emprendimiento_hombres',
    'remitidas_programas_emprendimiento_mujeres',
    'pqrs_radicados_total',
    'personas_orientadas',
    'colocados_40mil',
    'transnacionales',
    'hojas_vida_remitidas_exterior_total',
    'hojas_vida_remitidas_exterior_hombres',
    'hojas_vida_remitidas_exterior_mujeres',
    'personas_colocadas_exterior_total',
    'personas_colocadas_exterior_hombres',
    'personas_colocadas_exterior_mujeres',
    'empleadores_registrados_exterior',
    'vacantes_registradas_exterior',
    'observaciones',
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
    return $this->activo == Reporte::REGISTRO_ACTIVO;
  }

  public function puntoAtencion()
  {
    return $this->belongsTo(PuntoAtencion::class, 'punto_atencion_id');
  }

  public function responsable()
  {
    return $this->morphTo();
  }

  public function periodo()
  {
    return $this->belongsTo(Periodo::class);
  }

}
