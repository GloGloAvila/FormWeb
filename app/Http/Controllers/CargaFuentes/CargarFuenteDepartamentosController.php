<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

use App\Models\Departamento;

class CargarFuenteDepartamentosController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename){

    if (($handle = fopen($this->sources_path.$filename, 'r')) !== FALSE) {

      while ( ($data = fgetcsv ( $handle, 5000, ',')) !== FALSE ) {

        $departamento = new Departamento();
        $departamento->nombre = $this->obtenerNombreDepartamento($data[1]);
        $departamento->codigo = iconv("Windows-1252", "UTF-8", $data[0]);
        $departamento->divipola = iconv("Windows-1252", "UTF-8", $data[2]);
        $departamento->activo = 1;
        $departamento->save();

      }

      fclose ($handle);

    }
  }

  private function obtenerNombreDepartamento ($nombre) {
    return ucwords(mb_strtolower(iconv("Windows-1252", "UTF-8", $nombre)));
  }

}
