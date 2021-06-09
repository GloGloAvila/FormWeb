<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Http\Resources\ReporteMensualExcelResource;

use App\Models\Reporte;
use Illuminate\Support\Facades\Log;


class ReporteMesPrestador implements FromCollection, WithHeadings
{

    protected $periodo;

    function __construct($periodo)
    {
        $this->periodo = $periodo;
    }
    
      /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
       
  
      //Buscando funcionario relacionado al punto de atención
  //     $puntoAtencionFuncionario = PuntoAtencionFuncionario::where('punto_atencion_id', $puntoAtencion->id)->first();
  //     $funcionario = null;
  //     if (isset($puntoAtencionFuncionario->funcionario_id)) {
   //       $funcionario = Funcionario::find($puntoAtencionFuncionario->funcionario_id);
   //      }
  
  
        $reporte = Reporte::where('periodo_id', $this->periodo->id)
                          ->where('responsable_id',150)->get(); 
  
        return ReporteMensualExcelResource::collection($reporte);
    }

    public function headings(): array
    {
        return [
            'Código prestador',
            'Código punto atención',
            'Año',
            'Mes',
            'Tipo',
            'Prestador nombre',
            'Departamento punto atención',
            'Municipio punto atención',
            'Punto atención nombre',
            'Total personas inscritas',
            'Total personas inscritas hombres',
            'Total personas inscritas hombres victimas',
            'Total personas inscritas hombres jovenes',
            'Total personas inscritas hombres PcD',
            'Total personas inscritas hombres Migrantes',
            'Total personas inscritas hombres Grupo',
            'Total personas inscritas mujeres',
            'Total personas inscritas mujeres victimas',
            'Total personas inscritas mujeres jovenes',
            'Total personas inscritas mujeres PcD',
            'Total personas inscritas mujeres Migrantes',
            'Total personas inscritas mujeres Grupo',
            

            'Total remisiones a empleadores',
            'Total remisiones a empleadores hombres',
            'Total remisiones a empleadores mujeres',
            'Total remisiones a empleadores_a',
            'Total remisiones a empleadores hombres_a',
            'Total remisiones a empleadores mujeres_a',
            'Total remisiones a empleadores_bc',
            'Total remisiones a empleadores hombres_bc',
            'Total remisiones a empleadores mujeres_bc',
            'Total colocados',
            'Total colocados hombres',
            'Total colocados mujeres',
            'Total colocados víctimas',
            'Total colocados jóvenes',
            'Total colocados discapacidad',
            'Total empleadores inscritos',
            'Total personas remitidas formación',
            'Total personas remitidas hombres',
            'Total personas remitidas competencias hombres',
            'Total personas remitidas tic hombres',
            'Total personas remitidas alfabetización hombres',
            'Total personas remitidas entrenamiento hombres',
            'Total personas remitidas técnico hombres',
            'Total personas remitidas mujeres',
            'Total personas remitidas competencias mujeres',
            'Total personas remitidas tic mujeres',
            'Total personas remitidas alfabetización mujeres',
            'Total personas remitidas entrenamiento mujeres',
            'Total personas remitidas técnico mujeres',
            'Total personas culminaron formacion',
            'Total personas culminaron formacion hombres',
            'Total personas culminaron formacion competencias_hombres',
            'Total personas culminaron formacion tic_hombres',
            'Total personas culminaron formacion alfabetizacion_hombres',
            'Total personas culminaron formacion entrenamiento_hombres',
            'Total personas culminaron formacion tecnico_hombres',
            'Total personas culminaron formacion mujeres',
            'Total personas culminaron formacion competencias_mujeres',
            'Total personas culminaron formacion tic_mujeres',
            'Total personas culminaron formacion alfabetizacion_mujeres',
            'Total personas culminaron formacion entrenamiento_mujeres',
            'Total personas culminaron formacion tecnico_mujeres',
            'Total personas remitidas programas emprendimiento',
            'Total personas remitidas programas emprendimiento hombres',
            'Total personas remitidas programas emprendimiento mujeres',
            'Total personas atendidas',
            'Total personas atendidas hombres',
            'Total personas atendidas mujeres',
            'Total personas atendidas en talleres',
            'Total personas atendidas en talleres hombres',
            'Total personas atendidas en talleres mujeres',
            'Total PQRS radicados',
            'Presta servicios de gestión y colocación de empleo en el exterior',
            'Total hojas vida remitidas exterior',
            'Total hojas vida remitidas exterior hombres',
            'Total hojas vida remitidas exterior mujeres',
            'Total personas colocadas exterior',
            'Total personas colocadas exterior hombres',
            'Total personas colocadas exterior mujeres',
            'Total empleadores registrados exterior',
            'Total vacantes registradas exterior',
            'Punto atencion correo',
            'Punto atencion dirección',
            'Punto atencion fecha registro',
            'Observaciones',
            'Coordinador nombre',
            'Coordinador correo',
            'Coordinador teléfono',
            'Coordinador celular',
            'Responsable nombre',
            'Responsable correo',
            'Responsable teléfono',
            'Responsable celular',
        ];
    }
}
