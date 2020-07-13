<?php

namespace App\Http\Controllers\CargaFuentes;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;

use App\Models\Funcionario;
use App\Models\Prestador;
use App\Models\Opcion;

class CargarFuenteFuncionariosController extends RutaFuenteController
{
  public function __construct()
  {
    parent::__construct();
  }

  public function cargarFuente($filename){

    if (($handle = fopen($this->sources_path.$filename, 'r')) !== FALSE) {

      while ( ($data = fgetcsv ( $handle, 5000, ',')) !== FALSE ) {

        $prestadorMigracionId = iconv("Windows-1252", "UTF-8", $data[0]);

        $prestador = Prestador::obtenerPrestadorXMigracionId($prestadorMigracionId);

        if(isset($prestador->id)) {

          $tipoFuncionario = Opcion::getOpcionXGrupoXAbreviatura('tipo_funcionario', 'RL');
          $correoFuncionario = iconv("Windows-1252", "UTF-8", $data[10]);
  
          if(!Funcionario::correoExistente($correoFuncionario) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
  
            //Cargando funcionario tipo representante legal
            $funcionarioTipoRepresentanteLegal = new Funcionario();
            $funcionarioTipoRepresentanteLegal->prestador_id = $prestador->id;
            $funcionarioTipoRepresentanteLegal->tipo_funcionario_id = isset($tipoFuncionario->id) ? $tipoFuncionario->id : null;
            $funcionarioTipoRepresentanteLegal->nombre = iconv("Windows-1252", "UTF-8", $data[8]);
            $funcionarioTipoRepresentanteLegal->apellido = iconv("Windows-1252", "UTF-8", $data[9]);
            $funcionarioTipoRepresentanteLegal->email = $correoFuncionario;
            $funcionarioTipoRepresentanteLegal->password = bcrypt('Pa2sword..');
            $funcionarioTipoRepresentanteLegal->telefono = iconv("Windows-1252", "UTF-8", $data[11]);
            $funcionarioTipoRepresentanteLegal->celular = iconv("Windows-1252", "UTF-8", $data[12]);
  
            $funcionarioTipoRepresentanteLegal->save();
          }
        
          $tipoFuncionario = Opcion::getOpcionXGrupoXAbreviatura('tipo_funcionario', 'C');
          $correoFuncionario = iconv("Windows-1252", "UTF-8", $data[15]);
          
          if(!Funcionario::correoExistente($correoFuncionario) && isset($correoFuncionario) && $correoFuncionario !== 'NULL') {
            
            //Cargando funcionario tipo contacto
            $funcionarioTipoContacto = new Funcionario();
            $funcionarioTipoContacto->prestador_id = $prestador->id;
            $funcionarioTipoContacto->tipo_funcionario_id = isset($tipoFuncionario->id) ? $tipoFuncionario->id : null;
            $funcionarioTipoContacto->nombre = iconv("Windows-1252", "UTF-8", $data[13]);
            $funcionarioTipoContacto->apellido = iconv("Windows-1252", "UTF-8", $data[14]);
            $funcionarioTipoContacto->email = $correoFuncionario;
            $funcionarioTipoContacto->password = bcrypt('Pa2sword..');
            $funcionarioTipoContacto->telefono = iconv("Windows-1252", "UTF-8", $data[16]);
            $funcionarioTipoContacto->celular = iconv("Windows-1252", "UTF-8", $data[17]);
        
            $funcionarioTipoContacto->save();
          }          
  
        }

      }

      fclose ($handle);

    }
  }

}
