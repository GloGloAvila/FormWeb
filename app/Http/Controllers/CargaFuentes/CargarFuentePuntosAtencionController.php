<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
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

        $puntoAtencion = new PuntoAtencion();
        $puntoAtencion->migracion_id = iconv("Windows-1252", "UTF-8", $data[0]);
        $puntoAtencion->prestador_id = $this->obtenerPrestadorId($data[2]);
        $puntoAtencion->nombre = iconv("Windows-1252", "UTF-8", $data[1]);

        // 'migracion_id',
        // 'prestador_id',
        // 'departamento_id',
        // 'municipio_id',
        // 'nombre',
        // 'correo',
        // 'direccion',
        // 'nombre_contacto',
        // 'apellido_contacto',
        // 'correo_contacto',
        // 'telefono_contacto',
        // 'celular_contacto',
        // 'autorizacion',
        // 'pagina_web',
        // 'fecha_registro',
        // 'observaciones',
        // 'nombre_representante',
        // 'apellido_representante',
        // 'correo_representante',
        // 'telefono_representante',
        // 'celular_representante',
        // 'palabra_clave',
    
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
