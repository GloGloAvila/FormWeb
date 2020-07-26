<?php

namespace App\Http\Controllers\Periodo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\PuntosAtencionResource;

use App\Models\Prestador;
use App\Models\Periodo;

class PuntoAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Prestador  $prestador
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function index(Periodo $periodo, Prestador  $prestador)
    {
        $puntosAtencion = $prestador->puntosAtencion()
            ->where('activo', 1)
            ->with('departamento')
            ->with('municipio')
            ->with('prestador')
            ->orderBy('nombre', 'asc')
            ->get();

        $puntosAtencionCollection = [];
        foreach ($puntosAtencion as $puntoAtencion) {
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
