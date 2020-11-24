<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class FuncionarioResource extends JsonResource
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
            "prestador_id" => $this->prestador_id,
            "tipo_funcionario_id" => $this->tipo_funcionario_id,
            "tipo_funcionario" => $this->tipoFuncionario,
            "prestador_id" => $this->prestador_id,
            "prestador" => $this->prestador,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "fullname" => $this->fullname,
            "email" => $this->email,
            "telefono" => $this->telefono,
            "celular" => $this->celular,
            "activo" => $this->activo,
        ];
    }

}
