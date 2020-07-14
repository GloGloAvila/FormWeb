<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Log;

use App\Models\PuntoAtencion;
use App\Models\Prestador;
use App\Models\Opcion;

class CargarFuentePuntosAtencionController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename){

    if (($handle = fopen($this->sources_path.$filename, 'r')) !== FALSE) {

      while ( ($data = fgetcsv ( $handle, 5000, ',')) !== FALSE ) {

        $codigoDepartamento = iconv("Windows-1252", "UTF-8", $data[3]);
        $departamento = Departamento::obtenerDepartamentoXCodigo($codigoDepartamento);

        $codigoMunicipio = iconv("Windows-1252", "UTF-8", $data[4]);
        $municipio = Municipio::obtenerMunicipioXCodigo($codigoMunicipio);

        $puntoAtencion = new PuntoAtencion();
        $puntoAtencion->migracion_id = iconv("Windows-1252", "UTF-8", $data[2]) . iconv("Windows-1252", "UTF-8", $data[0]);
        $puntoAtencion->prestador_id = $this->obtenerPrestadorId($data[2]);
        $puntoAtencion->departamento_id = isset($departamento->id) ? $departamento->id : null;
        $puntoAtencion->municipio_id = isset($municipio->id) ? $municipio->id : null;
        $puntoAtencion->codigo = iconv("Windows-1252", "UTF-8", $data[0]);
        $puntoAtencion->nombre = iconv("Windows-1252", "UTF-8", $data[1]);
        $puntoAtencion->sitio_web = iconv("Windows-1252", "UTF-8", $data[8]);
        $puntoAtencion->correo_electronico = iconv("Windows-1252", "UTF-8", $data[5]);
        $puntoAtencion->direccion = iconv("Windows-1252", "UTF-8", $data[6]);
        $puntoAtencion->fecha_registro = iconv("Windows-1252", "UTF-8", $data[9]);
    
        $puntoAtencion->save();

      }

      fclose ($handle);

    }
  }

  private function obtenerPrestadorId ($migracionId) {
    $prestador = Prestador::where('migracion_id', $migracionId)->first();
    $prestador_id = isset($prestador->id) ? $prestador->id : 0; 
    return $prestador_id;
  }

}
