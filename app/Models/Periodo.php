<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\Prestador;
use App\Models\Vigencia;
use App\Models\Reporte;
use App\Models\Mes;

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

  public function fechaPermitida($fecha)
  {
    return $fecha >= $this->fecha_inicio && $fecha <= $this->fecha_fin;
  }

  public function fechaPendiente($fecha)
  {
    return $fecha <= $this->fecha_fin;
  }

  public function tieneReporte()
  {
    return $this->reportes()->count() > 0;
  }

  public function obtenerEstadoReporte()
  {
    $esFechaPermitida = $this->fechaPermitida(Carbon::parse(Carbon::now())->toDateString());
    $esFechaPendiente = $this->fechaPendiente(Carbon::parse(Carbon::now())->toDateString());
    $tieneReporte = $this->tieneReporte();

    $estado = 'Pendiente';
    if ($tieneReporte) {
      $estado = 'Reportado';

      // Evaluar si todos los prestadores presentaron reporte de lo contrario está imcompleto
      $prestadores = Prestador::where('activo', 1)->get();
      $totalEstadoPendiente = 0;
      $totalEstadoReportado = 0;
      $totalEstadoEnProceso = 0;
      $totalEstadoIncompleto = 0;
      $totalEstadoSinReporte = 0;

      $periodo = Periodo::find($this->id);
      foreach ($prestadores as $prestador) {
        switch ($prestador->obtenerEstadoReporte($periodo)) {
          case 'Pendiente':
            $totalEstadoPendiente++;
          case 'Reportado':
            $totalEstadoReportado++;
            break;
          case 'En proceso':
            $totalEstadoEnProceso++;
            break;
          case 'Incompleto':
            $totalEstadoIncompleto++;
            break;
          case 'Sin reporte':
            $totalEstadoSinReporte++;
            break;
        }
      }

      if ($esFechaPermitida) {
        $estado = 'En proceso';
        if ($totalEstadoPendiente === 0 && $totalEstadoEnProceso === 0 && $totalEstadoIncompleto === 0 && $totalEstadoSinReporte === 0) {
          $estado = 'Reportado';
        }
      } else {
        if ($totalEstadoPendiente || $totalEstadoIncompleto || $totalEstadoSinReporte) {
          $estado = 'Incompleto';
        }
      }
    } else {
      if (!$esFechaPermitida) {
        $estado = 'Sin reporte';
      }
      if ($esFechaPendiente) {
        $estado = 'Pendiente';
      }
      if ($esFechaPermitida) {
        $estado = 'En proceso';
      }
    }

    if ($this->fecha_inicio < Carbon::parse('2018-12-01')->toDateString() && $this->fecha_fin < Carbon::parse('2018-12-01')->toDateString()) {
      $estado = 'No aplica';
    }

    return $estado;
  }

  public function vigencia()
  {
    return $this->belongsTo(Vigencia::class);
  }

  public function mes()
  {
    return $this->belongsTo(Mes::class);
  }

  public function reportes()
  {
    return $this->hasMany(Reporte::class);
  }
}
