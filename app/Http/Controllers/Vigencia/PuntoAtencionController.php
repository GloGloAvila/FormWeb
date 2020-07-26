<?php

namespace App\Http\Controllers\Vigencia;

use App\Http\Controllers\Controller;
use App\Http\Resources\PuntosAtencionResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\PuntoAtencion;
use App\Models\Prestador;
use App\Models\Vigencia;
use App\Models\Periodo;

class PuntoAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Prestador  $prestador
     * @param  \App\Models\Vigencia  $vigencia
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function index(Vigencia $vigencia, Periodo $periodo, Prestador  $prestador)
    {
        $puntosAtencion = $prestador->puntosAtencion()
            ->with('departamento')
            ->with('municipio')
            ->with('prestador')
            ->orderBy('nombre', 'asc')
            ->get();

        $puntosAtencionCollection = [];
        foreach ($puntosAtencion as $puntoAtencion) {
            $puntoAtencion['vigencia'] = $vigencia;
            $puntoAtencion['periodo'] = $periodo;
            $puntosAtencionCollection[] = $puntoAtencion; 
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => PuntosAtencionResource::collection($puntosAtencionCollection)
            ],
            200
        );
    }
}
