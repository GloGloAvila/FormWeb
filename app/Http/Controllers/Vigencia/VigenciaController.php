<?php

namespace App\Http\Controllers\Vigencia;

use App\Http\Resources\VigenciaResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Vigencia;
use App\Models\Periodo;
use App\Models\Mes;
use App\User;

class VigenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vigencias = Vigencia::where('activo', 1)
            ->with(
                'periodos',
                'periodos.mes'
            )
            // ->limit(1)
            ->orderBy('nombre', 'desc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => VigenciaResource::collection($vigencias)

            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request['data'];
        $vigencia = Vigencia::create($datos);

        $meses = Mes::all();

        foreach ($meses as $mes) {
            $periodo = new Periodo();

            $periodo->vigencia_id = $vigencia->id;
            $periodo->mes_id = $mes->id;
            $periodo->estado_reporte_id = 20;
            $periodo->fecha_inicio = $vigencia->nombre . '-' . $mes->descripcion . '-' . '01';
            $periodo->fecha_fin = $vigencia->nombre . '-' . $mes->descripcion . '-' . '15';

            $periodo->save();
        }

        $vigencia = Vigencia::where('id', $vigencia->id)
            ->with(
                'periodos',
                'periodos.mes',
                'periodos.estadoReporte'
            )->first();

        return response()->json(
            [
                'status' => 'success',
                'data' => $vigencia
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vigencia  $vigencia
     * @return \Illuminate\Http\Response
     */
    public function show(Vigencia $vigencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vigencia  $vigencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vigencia $vigencia)
    {
        $data = $request['data'];

        $vigencia->nombre = $data['nombre'];
        $vigencia->save();

        return response()->json(
            [
                'status' => 'success',
                'data' => $vigencia
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vigencia  $vigencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vigencia $vigencia)
    {
        //
    }
}
