<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class PrestadorResource extends JsonResource
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
            "tipo_prestador_id" => $this->tipo_prestador_id,
            "tipo_prestador" => $this->tipoPrestador,
            "nombre" => $this->nombre,
            "activo" => $this->activo,
            "estado" => $this->obtenerEstadoReporte($this->periodo)
        ];
    }

}
