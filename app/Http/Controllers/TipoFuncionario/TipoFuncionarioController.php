<?php

namespace App\Http\Controllers\TipoFuncionario;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\TipoFuncionario;

class TipoFuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposFuncionario = TipoFuncionario::where('activo', 1)
            ->orderBy('valor_texto', 'asc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $tiposFuncionario
            ],
            200
        );
    }
}
