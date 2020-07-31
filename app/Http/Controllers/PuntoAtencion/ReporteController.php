<?php

namespace App\Http\Controllers\PuntoAtencion;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\PuntosAtencionResource;

use App\Models\PuntoAtencion;
use App\Models\Periodo;
use App\Models\Reporte;

class ReporteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\PuntoAtencion $puntoAtencion
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function index(PuntoAtencion $puntoAtencion, Periodo $periodo)
    {
        // Listar el punto de atención con los datos después de la creación
        $reporte = Reporte::where('punto_atencion_id', $puntoAtencion->id)
            ->where('periodo_id', $periodo->id)
            ->first();

        return response()->json(
            [
                'status' => 'success',
                'data' => $reporte
            ],
            201
        );
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PuntoAtencion  $puntoAtencion
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PuntoAtencion $puntoAtencion, Periodo $periodo)
    {
        $datos = $request['data'];
        
        $datos['funcionario_id'] = Auth::guard('funcionario')->user()->id;
        $datos['punto_atencion_id'] = $puntoAtencion->id;
        $datos['periodo_id'] = $periodo->id;

        Reporte::create($datos);

        // Listar el punto de atención con los datos después de la creación
        $puntosAtencion = PuntoAtencion::where('id', $puntoAtencion->id)
            ->with('departamento')
            ->with('municipio')
            ->with('prestador')
            ->get();

        $puntosAtencionCollection = [];
        foreach ($puntosAtencion as $puntoAtencion) {
            $puntoAtencion['periodo'] = $periodo;
            $puntosAtencionCollection[] = $puntoAtencion;
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => PuntosAtencionResource::collection($puntosAtencionCollection)[0]
            ],
            201
        );
    }

}
