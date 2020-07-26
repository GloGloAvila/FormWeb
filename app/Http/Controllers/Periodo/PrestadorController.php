<?php

namespace App\Http\Controllers\Periodo;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Http\Resources\PrestadorResource;

use App\Models\Funcionario;
use App\Models\Prestador;
use App\Models\Periodo;
use App\User;

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

        if (Auth::guard('funcionario')->check()) {
            $usuario = Funcionario::find(Auth::guard('funcionario')->user()->id);
        } else {
            $usuario = User::find(Auth::user()->id);
        }

        if ($usuario->hasrole('ROLE_ADMINISTRADOR')) {
            $prestadores = Prestador::where('activo', 1)
                ->with('tipoPrestador')
                ->orderBy('nombre', 'asc')
                ->get();
        } else {
            $prestador = $usuario->prestador()->first();
            $prestadores = Prestador::where('activo', 1)
                ->where('id', $prestador->id)
                ->with('tipoPrestador')
                ->orderBy('nombre', 'asc')
                ->get();
        }

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
