<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\PuntoAtencionFuncionario;
use App\Models\PuntoAtencion;
use App\Models\Funcionario;
use App\Models\Prestador;
use App\Models\Vigencia;
use App\Models\Periodo;
use App\Models\Reporte;
use App\Models\Opcion;

class CargarFuenteReportesEstadisticasController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename)
  {

    if (($handle = fopen($this->sources_path . $filename, 'r')) !== FALSE) {

      while (($data = fgetcsv($handle, 5000, ',')) !== FALSE) {

        $prestadorMigracionId = iconv("Windows-1252", "UTF-8", $data[0]);
        $prestador = Prestador::obtenerPrestadorXMigracionId($prestadorMigracionId);

        $puntoAtencionMigracionId = iconv("Windows-1252", "UTF-8", $data[1]);
        $puntoAtencion = PuntoAtencion::obtenerPuntoAtencionXMigracionId($puntoAtencionMigracionId);

        // campo 2 -> Buscar vigencia
        $vigenciaArchivo = iconv("Windows-1252", "UTF-8", $data[2]);
        $vigencia = $this->obtenerVigenciaXNombre($vigenciaArchivo);

        // campo 3 -> Buscar periodo
        $mesArchivo = iconv("Windows-1252", "UTF-8", $data[3]);
        $mes = Opcion::getOpcionXGrupoXValorNumerico('mes', $mesArchivo);

        $periodo = Periodo::where('vigencia_id', $vigencia->id)->where('mes_id', $mes->id)->first();

        if (isset($prestador->id) && isset($puntoAtencion->id) && isset($periodo->id)) {

          //Buscando funcionario relacionado al punto de atención
          $puntoAtencionFuncionario = PuntoAtencionFuncionario::where('punto_atencion_id', $puntoAtencion->id)->first();
          $funcionario = null;
          if (isset($puntoAtencionFuncionario->funcionario_id)) {
            $funcionario = Funcionario::find($puntoAtencionFuncionario->funcionario_id);
          } 

          if (isset($funcionario->id)) {
            $reporte = new Reporte();
            $reporte->periodo_id = $periodo->id;
            $reporte->punto_atencion_id = $puntoAtencion->id;
            $reporte->funcionario_id = $funcionario->id;
            $reporte->save();
          } else {
            Log::info('No tiene funcionario relacionado');
          }
        } else {

          Log::info('No tiene relacionado:');
          if (!isset($prestador->id)) Log::info('Prestador');
          if (!isset($puntoAtencion->id)) Log::info('Punto atencion');
          if (!isset($periodo->id)) Log::info('Periodo');

        }
      }

      fclose($handle);
    }
  }

  public function obtenerVigenciaXNombre($nombre)
  {
    return Vigencia::where('nombre', $nombre)->first();
  }
}
