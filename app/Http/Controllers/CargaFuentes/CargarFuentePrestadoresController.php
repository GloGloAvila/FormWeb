<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

use App\Models\Prestador;
use App\Models\Opcion;

class CargarFuentePrestadoresController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename){

    if (($handle = fopen($this->sources_path.$filename, 'r')) !== FALSE) {

      while ( ($data = fgetcsv ( $handle, 5000, ',')) !== FALSE ) {

        $prestador = new Prestador();
        $prestador->migracion_id = iconv("Windows-1252", "UTF-8", $data[0]);
        $prestador->tipo_prestador_id = $this->obtenerTipoPrestador($data[2]);
        $prestador->nombre = $this->obtenerNombrePrestador($data[1]);
        $prestador->save();

      }

      fclose ($handle);

    }
  }

  private function obtenerNombrePrestador ($nombre) {
    return ucwords(mb_strtolower(iconv("Windows-1252", "UTF-8", $nombre)));
  }

  private function obtenerTipoPrestador ($tipoPrestadorId) {
    $opcion = Opcion::getOpcionXGrupoXValorNumerico('tipo_prestador', $tipoPrestadorId);
    $opcion_id = isset($opcion->id) ? $opcion->id : 1; 
    return $opcion_id;
  }

}
