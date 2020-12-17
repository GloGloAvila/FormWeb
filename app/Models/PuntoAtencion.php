<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Classes\Fecha;

use App\Models\Departamento;
use App\Models\Funcionario;
use App\Models\Municipio;
use App\Models\Prestador;

class PuntoAtencion extends Model
{

    use SoftDeletes;

    // Constantes para saber si el registro está activo
    const REGISTRO_ACTIVO = '1';
    const REGISTRO_INACTIVO = '0';

    const AUTORIZADO = '1';
    const NO_AUTORIZADO = '0';

    protected $table = 'puntos_atencion';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'migracion_id',
        'prestador_id',
        'departamento_id',
        'municipio_id',
        'migracion_id',
        'codigo',
        'nombre',
        'sitio_web',
        'correo_electronico',
        'direccion',
        'fecha_registro',
        'autorizado',
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

    // Función para saber si un punto de atención está autorizado
    public function estaAutorizado()
    {
        return $this->autorizado == PuntoAtencion::AUTORIZADO;
    }

    public function tieneReporte(Periodo $periodo)
    {
        return $this->reportes()->where('periodo_id', $periodo->id)->count() > 0;
    }

    public function obtenerEstadoReporte(Periodo $periodo)
    {
        $esFechaPermitida = $periodo->fechaPermitida(Fecha::obtenerFechaActual());
        $esFechaPendiente = $periodo->fechaPendiente(Fecha::obtenerFechaActual());
        $tieneReporte = $this->tieneReporte($periodo);

        $estado = 'Pendiente';
        if ($tieneReporte) {
            $estado = 'Reportado';
        } else {
            if (!$esFechaPermitida) {
                $estado = 'Sin reporte';
                if ($esFechaPendiente) {
                    $estado = 'Pendiente';
                }
            } else {
                $estado = 'En proceso';
            }
        }

        return $estado;
    }

    static public function obtenerPuntoAtencionXMigracionId($migracionId)
    {
        return PuntoAtencion::where('migracion_id', $migracionId)->first();
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'punto_atencion_id', 'id');
    }

    public function coordinador()
    {
        return $this->belongsToMany(Funcionario::class, 'punto_atencion_tiene_funcionarios')
            ->withPivot(
                'punto_atencion_id'
            )
            ->where('tipo_funcionario_id', 8)
            ->first();
    }
}
