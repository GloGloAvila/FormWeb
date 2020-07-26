<?php

namespace App\Http\Controllers\Periodo;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\PrestadorResource;

use App\Models\Prestador;
use App\Models\Periodo;

class PrestadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function index(Periodo $periodo)
    {
        $prestadores = Prestador::where('activo', 1)            
            ->with('tipoPrestador')
            ->orderBy('nombre', 'asc')
            ->get();

        $prestadoresCollection = [];
        foreach ($prestadores as $prestador) {
            $prestador['periodo'] = $periodo;
            $prestadoresCollection[] = $prestador; 
        }

        return response()->json(
            [
                'status' => 'success',
                'data' => PrestadorResource::collection($prestadoresCollection)
            ],
            200
        );
    }
}
