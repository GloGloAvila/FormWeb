<?php

namespace App\Http\Controllers\Prestador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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
}
