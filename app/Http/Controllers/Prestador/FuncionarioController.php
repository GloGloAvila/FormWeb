<?php

namespace App\Http\Controllers\Prestador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\FuncionarioResource;
use App\Models\Funcionario;
use App\Models\Prestador;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function index(Prestador  $prestador)
    {
        $funcionarios = $prestador->funcionarios()
            ->with('tipoFuncionario')
            ->with('prestador')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $funcionarios
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Prestador  $prestador
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Prestador $prestador)
    {
        $request->validate([
            'tipo_funcionario_id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|unique:funcionarios|email'
        ]);

        $request['password'] = bcrypt('`.!');
        $request['prestador_id'] = $prestador->id;

        $funcionario = Funcionario::create($request->all());

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Prestador $prestador
     * @param  Funcionario $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestador $prestador, Funcionario $funcionario)
    {

        $request->validate([
            'tipo_funcionario_id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:funcionarios,email,' . $funcionario->id
        ]);

        $funcionario->update($request->all());

        $funcionario = Funcionario::where('id', $funcionario->id)->get();

        $code = 201;
        return response()->json(
            [
                'data' => FuncionarioResource::collection($funcionario)[0]
            ],
            $code
        );
    }
}
