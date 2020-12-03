<?php

namespace App\Http\Controllers\Funcionario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\FuncionarioResource;

use App\Models\PuntoAtencionFuncionario;
use App\Models\PuntoAtencion;
use App\Models\Funcionario;

class PuntoAtencionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Funcionario $funcionario)
    {

        PuntoAtencionFuncionario::updateOrCreate([
            'funcionario_id' => $funcionario->id,
            'punto_atencion_id' => $request['id'],
            'activo' => 1
        ]);

        $funcionario = Funcionario::where('id', $funcionario->id)->get();

        $code = 201;
        return response()->json(
            [
                'data' => FuncionarioResource::collection($funcionario)[0]
            ],
            $code
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Funcionario  $funcionario
     * @param  PuntoAtencion  $puntoAtencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario  $funcionario, PuntoAtencion $puntoAtencion)
    {
        $puntoAtencionFuncionario = PuntoAtencionFuncionario::where('funcionario_id', $funcionario->id)
        ->where('punto_atencion_id', $puntoAtencion->id)->first();

        // PuntoAtencionFuncionario::destroy($puntoAtencionFuncionario->id);
        $puntoAtencionFuncionario->activo = 0;
        $puntoAtencionFuncionario->save();

        $funcionario = Funcionario::where('id', $funcionario->id)->get();

        $code = 200;
        return response()->json(
            [
                'data' => FuncionarioResource::collection($funcionario)[0]
            ],
            $code
        );
    }
}
