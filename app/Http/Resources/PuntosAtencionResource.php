<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\Reporte;
use App\Models\Periodo;
use App\Models\PuntoAtencion;

class PuntosAtencionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "migracion_id" => $this->migracion_id,
            "prestador_id" => $this->prestador_id,
            "departamento_id" => $this->departamento_id,
            "municipio_id" => $this->municipio_id,
            "codigo" => $this->codigo,
            "nombre" => $this->nombre,
            "sitio_web" => $this->sitio_web,
            "correo_electronico" => $this->correo_electronico,
            "direccion" => $this->direccion,
            "fecha_registro" => $this->fecha_registro,
            "autorizado" => $this->autorizado,
            "activo" => $this->activo,
            "estado" => $this->obtenerEstado($this->periodo),
            "departamento" => $this->departamento,
            "municipio" => $this->municipio,
            "prestador" => $this->prestador
        ];
    }

}
