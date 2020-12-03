<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use LaravelAndVueJS\Traits\LaravelPermissionToVueJS;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log;

use App\Models\TipoFuncionario;
use App\Models\Prestador;

class Funcionario extends Authenticatable
{

    use Notifiable;
    use LaravelPermissionToVueJS;
    use HasRoles;
    use SoftDeletes;

    // Constantes para saber si el registro está activo
    const REGISTRO_ACTIVO = '1';
    const REGISTRO_INACTIVO = '0';

    protected $guard = 'funcionario';
    protected $table = 'funcionarios';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prestador_id',
        'tipo_funcionario_id',
        'nombre',
        'apellido',
        'email',
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
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

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

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    public function tipoFuncionario()
    {
        return $this->belongsTo(TipoFuncionario::class, 'tipo_funcionario_id');
    }

    public function prestador()
    {
        return $this->belongsTo(Prestador::class);
    }

    public function reportes()
    {
        return $this->morphMany(Reporte::class, 'responsable');
    }

    public function puntosAtencion()
    {
        return $this->belongsToMany(PuntoAtencion::class, 'punto_atencion_tiene_funcionarios')
        ->where('puntos_atencion.activo', 1)
        ->where('punto_atencion_tiene_funcionarios.activo', 1)
        ->whereNull('punto_atencion_tiene_funcionarios.deleted_at')
        ->orderby('puntos_atencion.codigo', 'asc');
    }

    public function puntosAtencionSinAsociar()
    {
        $prestador = $this->prestador()->first();
        $puntosAtencionIDs = $this->puntosAtencion->pluck('id');
        return $prestador->puntosAtencion->whereNotIn('id', $puntosAtencionIDs)->toArray();
    }

}
