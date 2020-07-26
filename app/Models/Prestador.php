<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

  public function estadoReporte(Periodo $periodo)
  {
    $puntosAtencion = $this->puntosAtencion()->get();
    $totalEstadoPendiente = 0;
    $totalEstadoReportado = 0;
    $totalEstadoSinReporte = 0;

    foreach ($puntosAtencion as $puntoAtencion) {
      switch ($puntoAtencion->obtenerEstadoReporte($periodo)) {
        case 'Pendiente':
          $totalEstadoPendiente++;
          break;
        case 'Reportado':
          $totalEstadoReportado++;
          break;
        case 'Sin reporte':
          $totalEstadoSinReporte++;
          break;
      }
    }

    $estado = 'En proceso';
    if ($totalEstadoPendiente > 0) {
      $estado = 'Pendiente';
    }
    if ($totalEstadoSinReporte > 0 && $totalEstadoReportado === 0) {
      $estado = 'Sin reporte';
    }
    if ($totalEstadoSinReporte > 0 && $totalEstadoReportado > 0) {
      $estado = 'Incompleto';
    }
    if ($totalEstadoReportado > 0 && $totalEstadoSinReporte === 0 && $totalEstadoReportado === 0) {
      $estado = 'Reportado';
    }


    return $estado;
  }

  public function obtenerEstadoReporte(Periodo $periodo)
  {
    $esFechaPermitida = $periodo->fechaPermitida(Carbon::parse(Carbon::now())->toDateString());
    $estadoReporte = $this->estadoReporte($periodo);

    $estado = 'Pendiente';
    if ($estadoReporte === 'Reportado') {
      $estado = 'Reportado';
    } else {
      if (!$esFechaPermitida) {
        if ($estadoReporte === 'Sin reporte') {
          $estado = 'Sin reporte';
        }
        if ($estadoReporte === 'Incompleto') {
          $estado = 'Incompleto';
        }
      } else {
        $estado = 'En proceso';
      }
    }

    return $estado;
  }

  static public function obtenerPrestadorXMigracionId($migracionId)
  {
    return Prestador::where('migracion_id', $migracionId)->first();
  }

  public function tipoPrestador()
  {
    return $this->belongsTo(Opcion::class, 'tipo_prestador_id');
  }

  public function puntosAtencion()
  {
    return $this->hasMany(PuntoAtencion::class)
      ->where('puntos_atencion.activo', 1)
      ->orderby('puntos_atencion.codigo', 'asc');
  }
}
