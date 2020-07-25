<?php

namespace App\Http\Controllers\Prestador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\PuntoAtencion;
use App\Models\Prestador;

class PuntoAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function index(Prestador  $prestador)
    {
        $puntosAtencion = $prestador->puntosAtencion()
            ->with('departamento')
            ->with('municipio')
            ->with('prestador')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $puntosAtencion
            ],
            200
        );
    }
}
