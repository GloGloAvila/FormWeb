<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\PuntoAtencion;
use App\Models\Funcionario;
use App\Models\Prestador;
use App\Models\Opcion;
use App\Models\PuntoAtencionFuncionario;

class CargarFuenteFuncionariosController extends RutaFuenteController
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

        if (isset($prestador->id)) {

          $tipoFuncionario = Opcion::getOpcionXGrupoXAbreviatura('tipo_funcionario', 'RL');
          $correoFuncionario = iconv("Windows-1252", "UTF-8", $data[10]);

          //Cargando funcionario tipo representante legal
          $funcionario = Funcionario::where('email', $correoFuncionario)->first();
          
          if (!Funcionario::correoExistente($correoFuncionario) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
            
            $funcionario = new Funcionario();
            $funcionario->prestador_id = $prestador->id;
            $funcionario->tipo_funcionario_id = isset($tipoFuncionario->id) ? $tipoFuncionario->id : null;
            $funcionario->nombre = iconv("Windows-1252", "UTF-8", $data[8]);
            $funcionario->apellido = iconv("Windows-1252", "UTF-8", $data[9]);
            $funcionario->email = $correoFuncionario;
            $funcionario->password = bcrypt('Pa2sword..');
            $funcionario->telefono = iconv("Windows-1252", "UTF-8", $data[11]);
            $funcionario->celular = iconv("Windows-1252", "UTF-8", $data[12]);

            $funcionario->save();
          }

          if (isset($puntoAtencion->id) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
            PuntoAtencionFuncionario::firstOrCreate(
              [
                'punto_atencion_id' => $puntoAtencion->id,
                'funcionario_id' => $funcionario->id
              ]
            );
          }

          $tipoFuncionario = Opcion::getOpcionXGrupoXAbreviatura('tipo_funcionario', 'C');
          $correoFuncionario = iconv("Windows-1252", "UTF-8", $data[15]);

          //Cargando funcionario tipo contacto
          $funcionario = Funcionario::where('email', $correoFuncionario)->first();
          
          if (!Funcionario::correoExistente($correoFuncionario) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
            
            $funcionario = new Funcionario();
            $funcionario->prestador_id = $prestador->id;
            $funcionario->tipo_funcionario_id = isset($tipoFuncionario->id) ? $tipoFuncionario->id : null;
            $funcionario->nombre = iconv("Windows-1252", "UTF-8", $data[13]);
            $funcionario->apellido = iconv("Windows-1252", "UTF-8", $data[14]);
            $funcionario->email = $correoFuncionario;
            $funcionario->password = bcrypt('Pa2sword..');
            $funcionario->telefono = iconv("Windows-1252", "UTF-8", $data[16]);
            $funcionario->celular = iconv("Windows-1252", "UTF-8", $data[17]);

            $funcionario->save();
          } else {
          }

          if (isset($puntoAtencion->id) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
            PuntoAtencionFuncionario::firstOrCreate(
              [
                'punto_atencion_id' => $puntoAtencion->id,
                'funcionario_id' => $funcionario->id
              ]
            );
          }

        }
      }

      fclose($handle);
    }
  }
}
