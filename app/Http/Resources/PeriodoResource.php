<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class PeriodoResource extends JsonResource
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
            "vigencia_id" => $this->vigencia_id,
            "estado_reporte_id" => $this->estado_reporte_id,
            "mes_id" => $this->mes_id,
            "nombre" => $this->nombre,
            "fecha_inicio" => $this->fecha_inicio,
            "fecha_fin" => $this->fecha_fin,
            "activo" => $this->activo,
            "mes" => $this->mes,
            "estado" => $this->obtenerEstadoReporte()
        ];
    }

}
