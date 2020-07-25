<?php

namespace App\Http\Controllers\Prestador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Prestador;

class PrestadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestadores = Prestador::where('activo', 1)
            ->with('tipoPrestador')
            ->orderBy('nombre', 'asc')
            ->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $prestadores
            ],
            200
        );
    }

}
