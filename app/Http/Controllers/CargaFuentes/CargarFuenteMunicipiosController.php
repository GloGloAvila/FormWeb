<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

use App\Models\Departamento;
use App\Models\Municipio;

class CargarFuenteMunicipiosController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename){

    if (($handle = fopen($this->sources_path.$filename, 'r')) !== FALSE) {

      while ( ($data = fgetcsv ( $handle, 5000, ',')) !== FALSE ) {

        $codigoDepartamento = iconv("Windows-1252", "UTF-8", $data[2]);
        $departamento = Departamento::obtenerDepartamentoXCodigo($codigoDepartamento);

        $municipio = new Municipio();
        $municipio->nombre = $this->obtenerNombreMunicipio($data[1]);
        $municipio->codigo_departamento = $codigoDepartamento;
        $municipio->divipola = iconv("Windows-1252", "UTF-8", $data[0]);
        $municipio->departamento_id = isset($departamento->id) ? $departamento->id : null;
        $municipio->activo = 1;
        $municipio->save();

      }

      fclose ($handle);

    }
  }

  private function obtenerNombreMunicipio ($nombre) {
    return ucwords(mb_strtolower(iconv("Windows-1252", "UTF-8", $nombre)));
  }

}
