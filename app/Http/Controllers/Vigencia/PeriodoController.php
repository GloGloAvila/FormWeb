<?php

namespace App\Http\Controllers\Vigencia;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Vigencia;
use App\Models\Periodo;

class PeriodoController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vigencia  $vigencia
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vigencia $vigencia, Periodo $periodo)
    {
        $data = $request['data'];

        if($vigencia->id === $periodo->vigencia_id){
            $periodo->fecha_inicio = $data['fecha_inicio'];
            $periodo->fecha_fin = $data['fecha_fin'];
            $periodo->save();
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => $periodo
            ],
            200
        );
    }

}
