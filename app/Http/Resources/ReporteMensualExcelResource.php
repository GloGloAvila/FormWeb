<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReporteMensualExcelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'IDPrestador' => $this->puntoAtencion->prestador->migracion_id,
            'IDPunto' => $this->puntoAtencion->migracion_id,
            'anio' => $this->periodo->vigencia->nombre,
            'mes' => $this->periodo->mes->descripcion,
            'tipo_agencia' => $this->puntoAtencion->prestador->tipoPrestador->descripcion,
            'prestador_nombre' => $this->puntoAtencion->prestador->nombre,
            'departamento_nombre' => $this->puntoAtencion->departamento ? $this->puntoAtencion->departamento->nombre : '',
            'municipio_nombre' => $this->puntoAtencion->municipio ? $this->puntoAtencion->municipio->nombre : '',
            'punto_atencion_nombre' => $this->puntoAtencion->nombre,
            'personas_inscritas_total' => $this->personas_inscritas_total,
            'personas_inscritas_hombres' => $this->personas_inscritas_hombres,
            'personas_inscritas_mujeres' => $this->personas_inscritas_mujeres,
            'remisiones_a_empleadores_total' => $this->remisiones_a_empleadores_total,
            'remisiones_a_empleadores_hombres' => $this->remisiones_a_empleadores_hombres,
            'remisiones_a_empleadores_mujeres' => $this->remisiones_a_empleadores_mujeres,
            'remisiones_a_empleadores_total_a' => $this->remisiones_a_empleadores_total_a,
            'remisiones_a_empleadores_hombres_a' => $this->remisiones_a_empleadores_hombres_a,
            'remisiones_a_empleadores_mujeres_a' => $this->remisiones_a_empleadores_mujeres_a,
            'remisiones_a_empleadores_total_bc' => $this->remisiones_a_empleadores_total_bc,
            'remisiones_a_empleadores_hombres_bc' => $this->remisiones_a_empleadores_hombres_bc,
            'remisiones_a_empleadores_mujeres_bc' => $this->remisiones_a_empleadores_mujeres_bc,
            'colocados_total' => $this->colocados_total,
            'colocados_hombres' => $this->colocados_hombres,
            'colocados_mujeres' => $this->colocados_mujeres,
            'colocados_victimas' => $this->colocados_victimas,
            'colocados_jovenes' => $this->colocados_jovenes,
            'colocados_discapacidad' => $this->colocados_discapacidad,
            'empleadores_inscritos_total' => $this->empleadores_inscritos_total,
            'remitidas_formacion' => $this->remitidas_formacion,
            'remitidas_formacion_hombres' => $this->remitidas_formacion_hombres,
            'remitidas_formacion_competencias_hombres' => $this->remitidas_formacion_competencias_hombres,
            'remitidas_formacion_tic_hombres' => $this->remitidas_formacion_tic_hombres,
            'remitidas_formacion_alfabetizacion_hombres' => $this->remitidas_formacion_alfabetizacion_hombres,
            'remitidas_formacion_entrenamiento_hombres' => $this->remitidas_formacion_entrenamiento_hombres,
            'remitidas_formacion_tecnico_hombres' => $this->remitidas_formacion_tecnico_hombres,
            'remitidas_formacion_mujeres' => $this->remitidas_formacion_mujeres,
            'remitidas_formacion_competencias_mujeres' => $this->remitidas_formacion_competencias_mujeres,
            'remitidas_formacion_tic_mujeres' => $this->remitidas_formacion_tic_mujeres,
            'remitidas_formacion_alfabetizacion_mujeres' => $this->remitidas_formacion_alfabetizacion_mujeres,
            'remitidas_formacion_entrenamiento_mujeres' => $this->remitidas_formacion_entrenamiento_mujeres,
            'remitidas_formacion_tecnico_mujeres' => $this->remitidas_formacion_tecnico_mujeres,
            'culminaron_formacion' => $this->culminaron_formacion,
            'culminaron_formacion_hombres' => $this->culminaron_formacion_hombres,
            'culminaron_formacion_competencias_hombres' => $this->culminaron_formacion_competencias_hombres,
            'culminaron_formacion_tic_hombres' => $this->culminaron_formacion_tic_hombres,
            'culminaron_formacion_alfabetizacion_hombres' => $this->culminaron_formacion_alfabetizacion_hombres,
            'culminaron_formacion_entrenamiento_hombres' => $this->culminaron_formacion_entrenamiento_hombres,
            'culminaron_formacion_tecnico_hombres' => $this->culminaron_formacion_tecnico_hombres,
            'culminaron_formacion_mujeres' => $this->culminaron_formacion_mujeres,
            'culminaron_formacion_competencias_mujeres' => $this->culminaron_formacion_competencias_mujeres,
            'culminaron_formacion_tic_mujeres' => $this->culminaron_formacion_tic_mujeres,
            'culminaron_formacion_alfabetizacion_mujeres' => $this->culminaron_formacion_alfabetizacion_mujeres,
            'culminaron_formacion_entrenamiento_mujeres' => $this->culminaron_formacion_entrenamiento_mujeres,
            'culminaron_formacion_tecnico_mujeres' => $this->culminaron_formacion_tecnico_mujeres,
            'remitidas_programas_emprendimiento' => $this->remitidas_programas_emprendimiento,
            'remitidas_programas_emprendimiento_hombres' => $this->remitidas_programas_emprendimiento_hombres,
            'remitidas_programas_emprendimiento_mujeres' => $this->remitidas_programas_emprendimiento_mujeres,
            'personas_atendidas' => $this->personas_atendidas,
            'personas_atendidas_hombres' => $this->personas_atendidas_hombres,
            'personas_atendidas_mujeres' => $this->personas_atendidas_mujeres,
            'personas_atendidas_en_talleres' => $this->personas_atendidas_en_talleres,
            'personas_atendidas_en_talleres_hombres' => $this->personas_atendidas_en_talleres_hombres,
            'personas_atendidas_en_talleres_mujeres' => $this->personas_atendidas_en_talleres_mujeres,
            'pqrs_radicados_total' => $this->pqrs_radicados_total,
            'transnacionales' => $this->transnacionales,
            'hojas_vida_remitidas_exterior_total' => $this->hojas_vida_remitidas_exterior_total,
            'hojas_vida_remitidas_exterior_hombres' => $this->hojas_vida_remitidas_exterior_hombres,
            'hojas_vida_remitidas_exterior_mujeres' => $this->hojas_vida_remitidas_exterior_mujeres,
            'personas_colocadas_exterior_total' => $this->personas_colocadas_exterior_total,
            'personas_colocadas_exterior_hombres' => $this->personas_colocadas_exterior_hombres,
            'personas_colocadas_exterior_mujeres' => $this->personas_colocadas_exterior_mujeres,
            'empleadores_registrados_exterior' => $this->empleadores_registrados_exterior,
            'vacantes_registradas_exterior' => $this->vacantes_registradas_exterior,
            'punto_atencion_correo' => $this->puntoAtencion->correo_electronico,
            'punto_atencion_direccion' => $this->puntoAtencion->direccion,
            'punto_atencion_fecha_registro' => $this->puntoAtencion->fecha_registro,
            'observaciones' => $this->observaciones,
            // Coordinador
            'coordinador_nombre' => $this->puntoAtencion->coordinador() ? $this->puntoAtencion->coordinador()->fullName : '',
            'coordinador_correo' => $this->puntoAtencion->coordinador() ? $this->puntoAtencion->coordinador()->email : '',
            'coordinador_telefono' => $this->puntoAtencion->coordinador() ? $this->puntoAtencion->coordinador()->telefono : '',
            'coordinador_celular' => $this->puntoAtencion->coordinador() ? $this->puntoAtencion->coordinador()->celular : '',
            // Responsable reporte
            'responsable_nombre' => $this->responsable->name ? $this->responsable->name : $this->responsable->fullName,
            'responsable_correo' => $this->responsable->email,
            'responsable_telefono' => $this->responsable->name ? '' : $this->responsable->telefono,
            'responsable_celular' => $this->responsable->name ? '' : $this->responsable->celular,

        ];
    }
}
