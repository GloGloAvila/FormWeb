<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Classes\Fecha;
use Carbon\Carbon;

use App\Models\EstadoReporte;
use App\Models\Funcionario;
use App\Models\Prestador;
use App\Models\Vigencia;
use App\Models\Reporte;
use App\Models\Mes;
use App\User;

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

  public function fechaVencida($fecha)
  {
    return $fecha > $this->fecha_fin;
  }

  public function estadoPendiente()
  {
    return $this->estadoReporte()->first()->valor_texto === 'Pendiente';
  }

  public function tieneReporte()
  {
    return $this->reportes()->count() > 0;
  }

  public function calcularEstado()
  {

    $esFechaPermitida = $this->fechaPermitida(Fecha::obtenerFechaActual());
    $esFechaPendiente = $this->fechaPendiente(Fecha::obtenerFechaActual());
    $tieneReporte = $this->tieneReporte();

    $estado = 'Pendiente';

    if ($tieneReporte) {
      $estado = 'Reportado';

      // Evaluar si todos los prestadores presentaron reporte de lo contrario está imcompleto
      if (Auth::guard('funcionario')->check()) {
        $usuario = Funcionario::find(Auth::user()->id);
      } else {
        $usuario = User::find(Auth::guard('web')->user()->id);
      }

      if ($usuario->hasrole('ROLE_ADMINISTRADOR')) {
        $prestadores = Prestador::where('activo', 1)->get();
      } else {
        $prestador = $usuario->prestador()->first();
        $prestadores = Prestador::where('activo', 1)
          ->where('id', $prestador->id)
          ->get();
      }

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

  public function obtenerEstadoReporte()
  {
    $esFechaPermitida = $this->fechaPermitida(Fecha::obtenerFechaActual());
    $esFechaVencida = $this->fechaVencida(Fecha::obtenerFechaActual());

    $esEstadoPendiente = $this->estadoPendiente();

    $estado = 'Pendiente';
    if ($esEstadoPendiente && $esFechaPermitida) {
      $estado = $this->calcularEstado();
    } else if ($esFechaPermitida) {
      $estado = 'En proceso';
    } else {

      if ($esEstadoPendiente && $esFechaVencida) {
        // Si el estado es pendiente y la fecha está vencida, se debe calcular el estado del periodo
        $estado = $this->calcularEstado();
        if ($estado !== 'Pendiente' && $estado !== 'En proceso') {
          $this->estado_reporte_id = Opcion::getOpcionXGrupoXValorTexto('estado_reporte', $estado)->id;
          $this->save();
        }
      } else {
        // Si el estado no es pendiente ni la fecha está vencida, sólo se muestra el estado actual
        $estado = $this->estadoReporte()->first()->valor_texto;
      }
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

  public function estadoReporte()
  {
    return $this->belongsTo(EstadoReporte::class);
  }

  public function reportes()
  {
    return $this->hasMany(Reporte::class);
  }
}
