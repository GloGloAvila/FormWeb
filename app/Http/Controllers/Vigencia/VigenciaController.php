<?php

namespace App\Http\Controllers\Vigencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Vigencia;

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
                'periodos.mes',
                'periodos.estadoReporte'
            )
            ->orderBy('nombre', 'desc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $vigencias
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
        //
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
        //
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
