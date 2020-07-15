<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\Reporte;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('periodo_id');
          $table->unsignedInteger('punto_atencion_id');
          $table->unsignedInteger('funcionario_id');

          $table->integer('personas_inscritas_total')->default(0);
          $table->integer('personas_inscritas_hombres')->default(0);
          $table->integer('personas_inscritas_mujeres')->default(0);
          $table->integer('remisiones_a_empleadores_total')->default(0);
          $table->integer('remisiones_a_empleadores_hombres')->default(0);
          $table->integer('remisiones_a_empleadores_mujeres')->default(0);
          $table->integer('colocados_total')->default(0);
          $table->integer('colocados_hombres')->default(0);
          $table->integer('colocados_mujeres')->default(0);
          $table->integer('colocados_victimas')->default(0);
          $table->integer('colocados_jovenes')->default(0);
          $table->integer('colocados_discapacidad')->default(0);
          $table->integer('empleadores_inscritos_total')->default(0);
          $table->integer('vacantes_registradas_total')->default(0);
          $table->integer('vacantes_registradas_contrato_laboral')->default(0);
          $table->integer('vacantes_registradas_prestacion')->default(0);
          $table->integer('remitidas_gestion_empleo_total')->default(0);
          $table->integer('remitidas_entrevista_orientacion')->default(0);
          $table->integer('remitidas_talleres_orientacion')->default(0);
          $table->integer('personas_atendidas')->default(0);
          $table->integer('personas_atendidas_hombres')->default(0);
          $table->integer('personas_atendidas_mujeres')->default(0);
          $table->integer('personas_atendidas_en_talleres')->default(0);
          $table->integer('personas_atendidas_en_talleres_hombres')->default(0);
          $table->integer('personas_atendidas_en_talleres_mujeres')->default(0);
          $table->integer('remitidas_formacion')->default(0);
          $table->integer('remitidas_formacion_hombres')->default(0);
          $table->integer('remitidas_formacion_competencias_hombres')->default(0);
          $table->integer('remitidas_formacion_tic_hombres')->default(0);
          $table->integer('remitidas_formacion_alfabetizacion_hombres')->default(0);
          $table->integer('remitidas_formacion_entrenamiento_hombres')->default(0);
          $table->integer('remitidas_formacion_tecnico_hombres')->default(0);
          $table->integer('remitidas_formacion_mujeres')->default(0);
          $table->integer('remitidas_formacion_competencias_mujeres')->default(0);
          $table->integer('remitidas_formacion_tic_mujeres')->default(0);
          $table->integer('remitidas_formacion_alfabetizacion_mujeres')->default(0);
          $table->integer('remitidas_formacion_entrenamiento_mujeres')->default(0);
          $table->integer('remitidas_formacion_tecnico_mujeres')->default(0);
          $table->integer('culminaron_formacion')->default(0);
          $table->integer('culminaron_formacion_hombres')->default(0);
          $table->integer('culminaron_formacion_competencias_hombres')->default(0);
          $table->integer('culminaron_formacion_tic_hombres')->default(0);
          $table->integer('culminaron_formacion_alfabetizacion_hombres')->default(0);
          $table->integer('culminaron_formacion_entrenamiento_hombres')->default(0);
          $table->integer('culminaron_formacion_tecnico_hombres')->default(0);
          $table->integer('culminaron_formacion_mujeres')->default(0);
          $table->integer('culminaron_formacion_competencias_mujeres')->default(0);
          $table->integer('culminaron_formacion_tic_mujeres')->default(0);
          $table->integer('culminaron_formacion_alfabetizacion_mujeres')->default(0);
          $table->integer('culminaron_formacion_entrenamiento_mujeres')->default(0);
          $table->integer('culminaron_formacion_tecnico_mujeres')->default(0);
          $table->integer('remitidas_talleres_emprendimiento')->default(0);
          $table->integer('remitidas_servicios_complementarios')->default(0);
          $table->integer('talleres_realizados')->default(0);
          $table->integer('remitidas_programas_emprendimiento')->default(0);
          $table->integer('remitidas_programas_emprendimiento_hombres')->default(0);
          $table->integer('remitidas_programas_emprendimiento_mujeres')->default(0);
          $table->integer('pqrs_radicados_total')->default(0);
          $table->integer('personas_orientadas')->default(0);
          $table->integer('colocados_40mil')->default(0);
          $table->integer('transnacionales')->default(0);

          $table->longText('observaciones')->nullable();
          $table->boolean('activo')->default(Reporte::REGISTRO_ACTIVO);

          $table->timestamps();
          $table->softDeletes()->nullable();

          $table->foreign('periodo_id')->references('id')->on('periodos');
          $table->foreign('punto_atencion_id')->references('id')->on('puntos_atencion');
          $table->foreign('funcionario_id')->references('id')->on('funcionarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      Schema::dropIfExists('reportes');
      DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
