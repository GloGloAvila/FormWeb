<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

use App\Http\Resources\PeriodoResource;

class VigenciaResource extends JsonResource
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
            "nombre" => $this->nombre,
            "activo" => $this->activo,
            "periodos_2" => $this->periodos,
            "periodos" => PeriodoResource::collection($this->periodos)
        ];
    }

}
