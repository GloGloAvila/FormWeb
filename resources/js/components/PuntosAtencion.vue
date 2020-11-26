<template>
  <div>
    <v-app id="inspire">
      <v-dialog
        v-model="modalFormularioReporte"
        persistent
        max-width="80%"
        style="z-index: 1040"
      >
        <v-card>
          <v-card-title class="headline text-uppercase"
            >Resolución 293 de 2017 -
            {{ tituloFormularioReporte }}</v-card-title
          >

          <v-card-subtitle
            >En cumplimiento de lo enunciado en la Resolución 293 de 2017, se
            dispone este formulario, en caso de inquietudes por favor leer las
            recomendaciones del recuadro azul, y para un desplazamiento más
            rápido entre los campos utilice la tecla de
            tabulación.</v-card-subtitle
          >

          <v-card-text>
            <v-alert
              color="blue-grey lighten-1"
              dark
              icon="mdi-office-building"
              prominent
            >
              Formulario de reporte mensual del prestador
              <strong>
                ({{ prestador.migracion_id }})
                {{ prestador.nombre | uppercase }}
              </strong>
              y Punto de Atención
              <strong>
                ({{ prestador.migracion_id }}{{ puntoAtencion.codigo }})
                {{ puntoAtencion.nombre | uppercase }}
              </strong>
              <br />
              Periodo:
              <strong>
                {{ periodo.mes ? periodo.mes.valor_texto : "" }}
                {{ vigencia.nombre }}
              </strong>
            </v-alert>

            <v-stepper v-model="pasoFormulario" vertical>
              <v-stepper-step :complete="pasoFormulario > 1" step="1"
                >Número de Personas inscritas/registradas</v-stepper-step
              >
              <v-stepper-content step="1">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <small
                    >Es el número de personas que registraron/inscribieron su
                    hoja de vida en el sistema de información que le ha sido
                    autorizado al prestador, de manera asistida por el Punto de
                    Atención o autónoma (auto-registro de forma virtual), en el
                    mes de referencia. Esta información debe presentarse
                    desagregada por sexo: hombres y mujeres.</small
                  >
                </v-alert>
                <v-form ref="formPaso1" v-model="paso1Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="personasInscritasTotal"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.personas_inscritas_hombres"
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.personas_inscritas_mujeres"
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 2"
                      v-if="paso1Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 2" step="2"
                >Número de hojas de vida remitida a empleadores.</v-stepper-step
              >
              <v-stepper-content step="2">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Corresponde al número total de hojas de vida enviadas a
                      empleadores para procesos de selección y/o contratación en
                      el mes de referencia. Las remisiones de hojas de vida a
                      empleadores comprenden los siguientes casos:</small
                    >
                  </p>
                  <small>
                    <ol type="A">
                      <li>
                        Cuando el Punto de Atención del prestador efectúa
                        directamente el envío de las hojas de vida al empleador.
                      </li>
                      <li>
                        Cuando la persona inscrita/registrada se postula
                        directamente a una vacante a través del sistema de
                        información que le ha sido autorizado al prestador.
                      </li>
                      <li>
                        Cuando el empleador preselecciona directamente las hojas
                        de vida a través del sistema de información que le ha
                        sido autorizado al prestador.
                      </li>
                    </ol>
                  </small>
                </v-alert>
                <v-form ref="formPaso2" v-model="paso2Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="remisionesAEmpleadoresTotal"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.remisiones_a_empleadores_hombres
                          "
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.remisiones_a_empleadores_mujeres
                          "
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 1"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 3"
                      v-if="paso2Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 3" step="3"
                >Número de personas colocadas</v-stepper-step
              >
              <v-stepper-content step="3">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Corresponde al número total de personas que fueron
                      contratadas por el empleador como resultado de la gestión
                      y validación realizada por el Punto de Atención, en el mes
                      de referencia. Esta información debe presentarse
                      desagregada por sexo: hombres y mujeres.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso3" v-model="paso3Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="colocadosTotal"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.colocados_hombres"
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.colocados_mujeres"
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 2"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 4"
                      v-if="paso3Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 4" step="4"
                >Número de personas colocadas con enfoque
                diferencial</v-stepper-step
              >
              <v-stepper-content step="4">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <small>
                    <ol type="A">
                      <li>
                        <strong>Colocaciones Victimas</strong>: Aquellas
                        personas que individual o colectivamente hayan sufrido
                        un daño por hechos ocurridos a partir del 1° de enero de
                        1985, como consecuencia de infracciones al Derecho
                        Internacional Humanitario o de violaciones graves y
                        manifiestas a las normas internacionales de Derechos
                        Humanos, ocurridas con ocasión del conflicto armado
                        interno (Ley 1448 de 2011).
                      </li>
                      <li>
                        <strong>Colocaciones Jóvenes</strong>: Personas con una
                        edad menor o igual a 28 años.
                      </li>
                      <li>
                        <strong>Colocaciones con Discapacidad</strong>: Personas
                        con condición de discapacidad auditiva, cognitiva o
                        intelectual, física, psicosocial, sordoceguera o visual.
                      </li>
                    </ol>
                  </small>
                </v-alert>
                <v-form ref="formPaso4" v-model="paso4Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.colocados_victimas"
                          label="Victimas"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.colocados_jovenes"
                          label="Jóvenes"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.colocados_discapacidad"
                          label="Discapacidad"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 3"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 5"
                      v-if="paso4Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 5" step="5"
                >Número de empleadores registrados/inscritos.</v-stepper-step
              >
              <v-stepper-content step="5">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Es el número de empleadores (personas jurídicas) que se
                      registraron/ inscribieron en el sistema de información que
                      le ha sido autorizado al prestador, de manera asistida por
                      el Punto de Atención o autónoma (auto-registro de forma
                      virtual), en el mes de referencia.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso5" v-model="paso5Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4"></v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.empleadores_inscritos_total
                          "
                          label="TOTAL (*)"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 4"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 6"
                      v-if="paso5Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 6" step="6"
                >Número de personas atendidas en entrevista de orientación
                ocupacional.</v-stepper-step
              >
              <v-stepper-content step="6">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Corresponde al número de personas atendidas en
                      entrevistas individuales con un orientador ocupacional,
                      con el objetivo de identificar su perfil laboral y definir
                      acciones que contribuyan a mejorar su empleabilidad. Esta
                      información debe presentarse desagregada por sexo: hombres
                      y mujeres.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso6" v-model="paso6Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="personasAtendidas"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.personas_atendidas_hombres"
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.personas_atendidas_mujeres"
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 5"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 7"
                      v-if="paso6Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 7" step="7"
                >Número de personas atendidas en actividades grupales de
                orientación ocupacional.</v-stepper-step
              >
              <v-stepper-content step="7">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Es el número de personas atendidas en actividades
                      grupales, como talleres, en las cuales se brindan a los
                      buscadores de empleo herramientas y asesoría para la
                      búsqueda de empleo, identificación de alternativas
                      laborales, herramientas para el autoempleo, información
                      sobre programas de empleabilidad e información general del
                      mercado laboral. Esta información debe presentarse
                      desagregada por sexo: hombres y mujeres.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso7" v-model="paso7Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="personasAtendidasEnTalleres"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.personas_atendidas_en_talleres_hombres
                          "
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.personas_atendidas_en_talleres_mujeres
                          "
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 6"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 8"
                      v-if="paso7Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 8" step="8"
                >Número de personas direccionadas a programas de formación y
                capacitación para el trabajo.</v-stepper-step
              >
              <v-stepper-content step="8">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Hace referencia al número de personas que fueron
                      direccionadas (preinscritos o inscritos) a cursos y/o
                      programas, los cuales son ofrecidos directamente por el
                      prestador o por entidades externas, relacionados con
                      alguno de los siguientes tipos de formación, en el mes de
                      referencia:</small
                    >
                  </p>

                  <small>
                    <ol type="A">
                      <li>Formación en competencias claves y transversales.</li>
                      <li>
                        Formación en Tecnologías de la Información y las
                        Comunicaciones TIC.
                      </li>
                      <li>Alfabetización o bachillerato.</li>
                      <li>Entrenamiento o reentrenamiento técnico.</li>
                      <li>Técnico laboral.</li>
                    </ol>
                  </small>

                  <p>
                    <small
                      >Esta información debe presentarse desagregada para cada
                      uno de los tipos de formación.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso8" v-model="paso8Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="remitidasFormacion"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="remitidasFormacionHombres"
                          label="Hombres"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="remitidasFormacionMujeres"
                          label="Mujeres"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>

                  <v-container>
                    <v-alert
                      color="blue lighten-2"
                      border="top"
                      elevation="2"
                      colored-border
                    >
                      <v-subheader class="blue--text text--lighten-2">
                        <strong>HOMBRES</strong>
                      </v-subheader>

                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_competencias_hombres
                              "
                              label="Competencias claves transversales"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_tic_hombres
                              "
                              label="Tecnologías de la Información y la Comunicaciones TIC"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_alfabetizacion_hombres
                              "
                              label="Alfabetización o Bachillerato"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_entrenamiento_hombres
                              "
                              label="Entrenamiento o reentrenamiento técnico"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_tecnico_hombres
                              "
                              label="Técnico laboral"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-alert>
                  </v-container>

                  <v-container>
                    <v-alert
                      color="pink lighten-2"
                      border="top"
                      elevation="2"
                      colored-border
                    >
                      <v-subheader class="pink--text text--lighten-2">
                        <strong>MUJERES</strong>
                      </v-subheader>
                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_competencias_mujeres
                              "
                              label="Competencias claves transversales"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_tic_mujeres
                              "
                              label="Tecnologías de la Información y la Comunicaciones TIC"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_alfabetizacion_mujeres
                              "
                              label="Alfabetización o Bachillerato"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_entrenamiento_mujeres
                              "
                              label="Entrenamiento o reentrenamiento técnico"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.remitidas_formacion_tecnico_mujeres
                              "
                              label="Técnico laboral"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-alert>
                  </v-container>

                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 7"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 9"
                      v-if="paso8Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 9" step="9"
                >Número de personas direccionadas a programas de formación y
                capacitación para el trabajo.</v-stepper-step
              >
              <v-stepper-content step="9">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Hace referencia al número de personas que culminaron
                      cursos y/o programas, los cuales son ofrecidos
                      directamente por el prestador o por entidades externas,
                      relacionados con alguno de los siguientes tipos de
                      formación, en el mes de referencia:</small
                    >
                  </p>

                  <small>
                    <ol type="A">
                      <li>Formación en competencias claves y transversales.</li>
                      <li>
                        Formación en Tecnologías de la Información y las
                        Comunicaciones TIC.
                      </li>
                      <li>Alfabetización o bachillerato.</li>
                      <li>Entrenamiento o reentrenamiento técnico.</li>
                      <li>Técnico laboral.</li>
                    </ol>
                  </small>

                  <p>
                    <small
                      >Esta información debe presentarse desagregada para cada
                      uno de los tipos de formación.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso9" v-model="paso9Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="culminaronFormacion"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="culminaronFormacionHombres"
                          label="Hombres"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="culminaronFormacionMujeres"
                          label="Mujeres"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>

                  <v-container>
                    <v-alert
                      color="blue lighten-2"
                      border="top"
                      elevation="2"
                      colored-border
                    >
                      <v-subheader class="blue--text text--lighten-2">
                        <strong>HOMBRES</strong>
                      </v-subheader>

                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_competencias_hombres
                              "
                              label="Competencias claves transversales"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_tic_hombres
                              "
                              label="Tecnologías de la Información y la Comunicaciones TIC"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_alfabetizacion_hombres
                              "
                              label="Alfabetización o Bachillerato"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_entrenamiento_hombres
                              "
                              label="Entrenamiento o reentrenamiento técnico"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_tecnico_hombres
                              "
                              label="Técnico laboral"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-alert>
                  </v-container>

                  <v-container>
                    <v-alert
                      color="pink lighten-2"
                      border="top"
                      elevation="2"
                      colored-border
                    >
                      <v-subheader class="pink--text text--lighten-2">
                        <strong>MUJERES</strong>
                      </v-subheader>
                      <v-container>
                        <v-row>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_competencias_mujeres
                              "
                              label="Competencias claves transversales"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_tic_mujeres
                              "
                              label="Tecnologías de la Información y la Comunicaciones TIC"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_alfabetizacion_mujeres
                              "
                              label="Alfabetización o Bachillerato"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_entrenamiento_mujeres
                              "
                              label="Entrenamiento o reentrenamiento técnico"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="12" md="12">
                            <v-text-field
                              v-model="
                                formularioReporte.culminaron_formacion_tecnico_mujeres
                              "
                              label="Técnico laboral"
                              :disabled="puntoAtencionIndex === -1"
                              :rules="numeroRules"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-alert>
                  </v-container>

                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 8"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 10"
                      v-if="paso9Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 10" step="10"
                >Número de personas direccionadas a programas de
                emprendimiento</v-stepper-step
              >
              <v-stepper-content step="10">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Corresponde al número de personas direccionadas por el
                      prestador a programas específicos de emprendimiento para
                      personas que incursionan como emprendedores o que tienen
                      experiencia en emprendimiento, los cuales son ofrecidos
                      directamente por el prestador o por entidades externas,
                      tales como programas que ofrecen capital semilla, líneas
                      de financiamiento, asesoría en la estructuración de
                      proyectos y orientación a emprendedores entre
                      otros.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso10" v-model="paso10Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="remitidasProgramasEmprendimiento"
                          label="TOTAL (*)"
                          filled
                          disabled
                          dense
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.remitidas_programas_emprendimiento_hombres
                          "
                          label="Hombres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="
                            formularioReporte.remitidas_programas_emprendimiento_mujeres
                          "
                          label="Mujeres"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 9"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 11"
                      v-if="paso10Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 11" step="11"
                >Número de PQRSD radicados en el Punto de
                Atención.</v-stepper-step
              >
              <v-stepper-content step="11">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >Corresponde al Número de PQRSD radicados en el Punto de
                      Atención.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso11" v-model="paso11Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4"></v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="formularioReporte.pqrs_radicados_total"
                          label="TOTAL (*)"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="numeroRules"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 10"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 12"
                      v-if="paso11Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 12" step="12"
                >Observaciones</v-stepper-step
              >
              <v-stepper-content step="12">
                <v-alert
                  icon="mdi-alert-octagon-outline"
                  prominent
                  text
                  type="info"
                >
                  <p>
                    <small
                      >En el campo de observaciones por favor indiquenos en que
                      aspectos podemos mejorar.</small
                    >
                  </p>
                </v-alert>
                <v-form ref="formPaso12" v-model="paso12Valido">
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="12" md="12">
                        <v-textarea
                          counter
                          v-model="formularioReporte.observaciones"
                          label="Observaciones"
                          :disabled="puntoAtencionIndex === -1"
                          :rules="textoRules"
                        ></v-textarea>
                      </v-col>
                    </v-row>
                  </v-container>
                  <div style="display: flex; justify-content: space-around">
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 11"
                      dark
                      >Anterior</v-btn
                    >
                    <v-btn
                      color="blue-grey lighten-1"
                      @click="pasoFormulario = 13"
                      v-if="paso12Valido"
                      dark
                      >Siguiente</v-btn
                    >
                    <v-btn color="gray darken-1" disabled v-else
                      >Siguiente</v-btn
                    >
                  </div>
                </v-form>
              </v-stepper-content>
            </v-stepper>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" @click="cerrarFormularioReporte" dark
              >Cancelar</v-btn
            >
            <v-btn
              color="blue darken-1"
              @click="revisarFormulario"
              v-if="pasoFormulario === 13"
              dark
              >Revisar formulario</v-btn
            >
            <v-btn color="gray darken-1" disabled v-else
              >Revisar formulario</v-btn
            >
            <v-btn
              color="green darken-1"
              @click="guardarFormularioReporte"
              v-if="puntoAtencionIndex > -1 && pasoFormulario === 13"
              dark
              >Guardar</v-btn
            >
            <v-btn color="gray darken-1" disabled v-else>Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <CCard>
        <CCardBody>
          <CRow>
            <CCol sm="5">
              <h4 class="card-title mb-0">Puntos de atención</h4>
              <div class="small text-muted">Listado</div>
            </CCol>
          </CRow>
          <CRow>
            <CCol sm="12">
              <v-toolbar color="blue-grey lighten-5" class="mb-1">
                <v-text-field
                  prepend-inner-icon="mdi-office-building"
                  label="Buscar punto atención"
                  v-model="search"
                  hide-details
                  clearable
                  solo
                  flat
                ></v-text-field>
                <template v-if="$vuetify.breakpoint.mdAndUp">
                  <v-spacer></v-spacer>
                  <v-select
                    prepend-inner-icon="mdi-sort"
                    label="Ordenar por"
                    v-model="sortBy"
                    :items="keys"
                    hide-details
                    solo
                    flat
                  ></v-select>
                  <v-spacer></v-spacer>
                  <v-btn-toggle v-model="sortDesc" mandatory v-show="true">
                    <v-btn
                      large
                      depressed
                      color="blue-grey lighten-1"
                      :value="false"
                    >
                      <v-icon>mdi-arrow-up</v-icon>
                    </v-btn>
                    <v-btn
                      large
                      depressed
                      color="blue-grey lighten-1"
                      :value="true"
                    >
                      <v-icon>mdi-arrow-down</v-icon>
                    </v-btn>
                  </v-btn-toggle>
                </template>
              </v-toolbar>

              <br />

              <v-alert
                color="blue-grey lighten-1"
                dark
                icon="mdi-office-building"
                prominent
              >
                Listado de puntos de atención del prestador
                <strong>
                  ({{ prestador.migracion_id }})
                  {{ prestador.nombre | uppercase }}
                </strong>
                <br />
                Periodo:
                <strong>
                  {{ periodo.mes ? periodo.mes.valor_texto : "" }}
                  {{ vigencia.nombre }}
                </strong>
              </v-alert>

              <v-data-table
                :headers="headers"
                :items="puntosAtencion"
                :page.sync="page"
                :items-per-page.sync="itemsPerPage"
                :sort-by="ordenarPor(sortBy.toLowerCase())"
                :sort-desc="sortDesc"
                :search="search"
                loading-text="Cargando... Espere por favor"
                class="elevation-1"
                hide-default-footer
              >
                <template v-slot:[`header.id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.departamento_id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>

                <template v-slot:[`header.municipio_id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.codigo`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.nombre`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.accion`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>

                <template v-slot:item="{ item, index }">
                  <tr>
                    <td>{{ index + 1 + (page - 1) * 10 }}</td>
                    <td>{{ item.departamento.nombre.toUpperCase() }}</td>
                    <td>{{ item.municipio.nombre.toUpperCase() }}</td>
                    <td>
                      {{ prestador.migracion_id
                      }}{{ item.codigo.toUpperCase() }}
                    </td>
                    <td>{{ item.nombre.toUpperCase() }}</td>
                    <td>
                      <v-menu
                        bottom
                        origin="center center"
                        transition="scale-transition"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-chip
                            :color="getColor(item.estado)"
                            dark
                            v-bind="attrs"
                            v-on="on"
                            >{{ item.estado }}</v-chip
                          >
                        </template>
                        <v-list>
                          <v-list-item
                            v-if="
                              is('ROLE_PRESTADOR') &&
                              item.estado === 'En proceso'
                            "
                            @click="mostrarFormularioReporte(item)"
                          >
                            <v-list-item-title
                              >Reporte Mensual</v-list-item-title
                            >
                          </v-list-item>
                          <v-list-item
                            @click="mostrarReporteDiligenciado(item)"
                          >
                            <v-list-item-title
                              >Ver Reporte Diligenciado</v-list-item-title
                            >
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </td>
                  </tr>
                </template>

                <template v-slot:no-data>
                  <br />
                  <br />No tiene información registrada.
                  <br />
                  <br />
                  <v-btn color="warning" @click="cargarListado()"
                    >Recargar</v-btn
                  >
                  <br />
                  <br />
                </template>
              </v-data-table>

              <v-row class="mt-2" align="center" justify="center">
                <span class="grey--text">Registros por página</span>
                <v-menu offset-y>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      dark
                      text
                      color="blue-grey lighten-1"
                      class="ml-2"
                      v-bind="attrs"
                      v-on="on"
                    >
                      {{ itemsPerPage === -1 ? "Todo" : itemsPerPage }}
                      <v-icon>mdi-chevron-down</v-icon>
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-item
                      v-for="(number, index) in itemsPerPageArray"
                      :key="index"
                      @click="updateItemsPerPage(number)"
                    >
                      <v-list-item-title>{{ number }}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>

                <v-spacer></v-spacer>
                <span class="mr-4 grey--text"
                  >Mostrando registros del
                  {{ 1 + (page - 1) * itemsPerPage }} al
                  {{
                    itemsPerPage === -1
                      ? total
                      : total > (page - 1) * itemsPerPage + itemsPerPage
                      ? (page - 1) * itemsPerPage + itemsPerPage
                      : total
                  }}
                  de un total de {{ total }}</span
                >

                <v-spacer></v-spacer>
                <span class="mr-4 grey--text"
                  >Página {{ page }} de {{ numberOfPages }}</span
                >
                <v-btn
                  fab
                  dark
                  color="blue-grey lighten-1"
                  class="mr-1"
                  @click="formerPage"
                >
                  <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn
                  fab
                  dark
                  color="blue-grey lighten-1"
                  class="ml-1"
                  @click="nextPage"
                >
                  <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
              </v-row>
            </CCol>
          </CRow>
        </CCardBody>
      </CCard>
    </v-app>
  </div>
</template>

<script>
import puntoAtencion from "../services/puntoAtencion.js";
import reporte from "../services/reporte.js";

export default {
  name: "PuntosAtencion",
  components: {},
  mounted() {
    this.vigencia = JSON.parse(sessionStorage.getItem("datosVigencia"));
    this.periodo = JSON.parse(sessionStorage.getItem("datosPeriodo"));
    this.prestador = JSON.parse(sessionStorage.getItem("datosPrestador"));

    this.cargarListado();
  },
  data() {
    return {
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      itemsPerPageArray: [5, 10, 15, 20, "Todo"],
      search: "",
      filter: {},
      sortDesc: false,
      sortBy: "nombre",
      keys: ["Nombre", "Código", "Departamento", "Municipio", "Estado"],
      vigencia: {},
      periodo: {},
      prestador: {},
      modalFormularioReporte: false,
      modalFormularioDiligenciado: false,
      botonGuardar: true,
      pasoFormulario: 1,
      paso1Valido: true,
      paso2Valido: true,
      paso3Valido: true,
      paso4Valido: true,
      paso5Valido: true,
      paso6Valido: true,
      paso7Valido: true,
      paso8Valido: true,
      paso9Valido: true,
      paso10Valido: true,
      paso11Valido: true,
      paso12Valido: true,
      numeroRules: [
        (v) => v >= 0 || "Es un campo numérico obligatorio",
        (v) => /[0-9]/.test(v) || "Es un campo numérico obligatorio",
      ],
      textoRules: [
        (v) => !!v || "Es un campo obligatorio",
        (v) =>
          v.length <= 1000 ||
          "Este campo sólo permite un máximo de 1000 caracteres.",
      ],
      formularioReporteIndex: -1,
      formularioReporte: {
        personas_inscritas_total: 0,
        personas_inscritas_hombres: 0,
        personas_inscritas_mujeres: 0,
        remisiones_a_empleadores_total: 0,
        remisiones_a_empleadores_hombres: 0,
        remisiones_a_empleadores_mujeres: 0,
        colocados_total: 0,
        colocados_hombres: 0,
        colocados_mujeres: 0,
        colocados_victimas: 0,
        colocados_jovenes: 0,
        colocados_discapacidad: 0,
        empleadores_inscritos_total: 0,
        vacantes_registradas_total: 0,
        vacantes_registradas_contrato_laboral: 0,
        vacantes_registradas_prestacion: 0,
        remitidas_gestion_empleo_total: 0,
        remitidas_entrevista_orientacion: 0,
        remitidas_talleres_orientacion: 0,
        personas_atendidas: 0,
        personas_atendidas_hombres: 0,
        personas_atendidas_mujeres: 0,
        personas_atendidas_en_talleres: 0,
        personas_atendidas_en_talleres_hombres: 0,
        personas_atendidas_en_talleres_mujeres: 0,
        remitidas_formacion: 0,
        remitidas_formacion_hombres: 0,
        remitidas_formacion_competencias_hombres: 0,
        remitidas_formacion_tic_hombres: 0,
        remitidas_formacion_alfabetizacion_hombres: 0,
        remitidas_formacion_entrenamiento_hombres: 0,
        remitidas_formacion_tecnico_hombres: 0,
        remitidas_formacion_mujeres: 0,
        remitidas_formacion_competencias_mujeres: 0,
        remitidas_formacion_tic_mujeres: 0,
        remitidas_formacion_alfabetizacion_mujeres: 0,
        remitidas_formacion_entrenamiento_mujeres: 0,
        remitidas_formacion_tecnico_mujeres: 0,
        culminaron_formacion: 0,
        culminaron_formacion_hombres: 0,
        culminaron_formacion_competencias_hombres: 0,
        culminaron_formacion_tic_hombres: 0,
        culminaron_formacion_alfabetizacion_hombres: 0,
        culminaron_formacion_entrenamiento_hombres: 0,
        culminaron_formacion_tecnico_hombres: 0,
        culminaron_formacion_mujeres: 0,
        culminaron_formacion_competencias_mujeres: 0,
        culminaron_formacion_tic_mujeres: 0,
        culminaron_formacion_alfabetizacion_mujeres: 0,
        culminaron_formacion_entrenamiento_mujeres: 0,
        culminaron_formacion_tecnico_mujeres: 0,
        remitidas_talleres_emprendimiento: 0,
        remitidas_servicios_complementarios: 0,
        talleres_realizados: 0,
        remitidas_programas_emprendimiento: 0,
        remitidas_programas_emprendimiento_hombres: 0,
        remitidas_programas_emprendimiento_mujeres: 0,
        pqrs_radicados_total: 0,
        personas_orientadas: 0,
        colocados_40mil: 0,
        transnacionales: 0,
        observaciones: "",
      },
      formularioReporteDefault: {
        personas_inscritas_total: 0,
        personas_inscritas_hombres: 0,
        personas_inscritas_mujeres: 0,
        remisiones_a_empleadores_total: 0,
        remisiones_a_empleadores_hombres: 0,
        remisiones_a_empleadores_mujeres: 0,
        colocados_total: 0,
        colocados_hombres: 0,
        colocados_mujeres: 0,
        colocados_victimas: 0,
        colocados_jovenes: 0,
        colocados_discapacidad: 0,
        empleadores_inscritos_total: 0,
        vacantes_registradas_total: 0,
        vacantes_registradas_contrato_laboral: 0,
        vacantes_registradas_prestacion: 0,
        remitidas_gestion_empleo_total: 0,
        remitidas_entrevista_orientacion: 0,
        remitidas_talleres_orientacion: 0,
        personas_atendidas: 0,
        personas_atendidas_hombres: 0,
        personas_atendidas_mujeres: 0,
        personas_atendidas_en_talleres: 0,
        personas_atendidas_en_talleres_hombres: 0,
        personas_atendidas_en_talleres_mujeres: 0,
        remitidas_formacion: 0,
        remitidas_formacion_hombres: 0,
        remitidas_formacion_competencias_hombres: 0,
        remitidas_formacion_tic_hombres: 0,
        remitidas_formacion_alfabetizacion_hombres: 0,
        remitidas_formacion_entrenamiento_hombres: 0,
        remitidas_formacion_tecnico_hombres: 0,
        remitidas_formacion_mujeres: 0,
        remitidas_formacion_competencias_mujeres: 0,
        remitidas_formacion_tic_mujeres: 0,
        remitidas_formacion_alfabetizacion_mujeres: 0,
        remitidas_formacion_entrenamiento_mujeres: 0,
        remitidas_formacion_tecnico_mujeres: 0,
        culminaron_formacion: 0,
        culminaron_formacion_hombres: 0,
        culminaron_formacion_competencias_hombres: 0,
        culminaron_formacion_tic_hombres: 0,
        culminaron_formacion_alfabetizacion_hombres: 0,
        culminaron_formacion_entrenamiento_hombres: 0,
        culminaron_formacion_tecnico_hombres: 0,
        culminaron_formacion_mujeres: 0,
        culminaron_formacion_competencias_mujeres: 0,
        culminaron_formacion_tic_mujeres: 0,
        culminaron_formacion_alfabetizacion_mujeres: 0,
        culminaron_formacion_entrenamiento_mujeres: 0,
        culminaron_formacion_tecnico_mujeres: 0,
        remitidas_talleres_emprendimiento: 0,
        remitidas_servicios_complementarios: 0,
        talleres_realizados: 0,
        remitidas_programas_emprendimiento: 0,
        remitidas_programas_emprendimiento_hombres: 0,
        remitidas_programas_emprendimiento_mujeres: 0,
        pqrs_radicados_total: 0,
        personas_orientadas: 0,
        colocados_40mil: 0,
        transnacionales: 0,
        observaciones: "",
      },
      puntoAtencionIndex: -1,
      puntoAtencion: {
        activo: 0,
        autorizado: 0,
        codigo: "",
        correo_electronico: "",
        departamento: {},
        departamento_id: 0,
        direccion: "",
        estado: "",
        fecha_registro: "",
        id: 0,
        migracion_id: "",
        municipio: {},
        municipio_id: 0,
        nombre: "",
        prestador: {},
        prestador_id: 0,
        sitio_web: "",
      },
      puntoAtencionDefault: {
        activo: 0,
        autorizado: 0,
        codigo: "",
        correo_electronico: "",
        departamento: {},
        departamento_id: 0,
        direccion: "",
        estado: "",
        fecha_registro: "",
        id: 0,
        migracion_id: "",
        municipio: {},
        municipio_id: 0,
        nombre: "",
        prestador: {},
        prestador_id: 0,
        sitio_web: "",
      },
      headers: [
        {
          text: "Consecutivo",
          value: "id",
          sortable: false,
        },
        {
          text: "Departamento",
          value: "departamento_id",
          sortable: false,
        },
        {
          text: "Municipio",
          value: "municipio_id",
          sortable: false,
        },
        {
          text: "Código",
          value: "codigo",
          sortable: false,
        },
        {
          text: "Punto de Atención",
          value: "nombre",
          sortable: false,
        },
        {
          text: "ESTADO",
          value: "estado",
          sortable: false,
        },
      ],
      puntosAtencion: [],
    };
  },
  filters: {
    capitalize: function (value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
    uppercase: function (value) {
      if (!value) return "";
      value = value.toString();
      return value.toUpperCase();
    },
  },
  computed: {
    numberOfPages() {
      return Math.ceil(
        this.puntosAtencion.length /
          (this.itemsPerPage === -1
            ? this.puntosAtencion.length
            : this.itemsPerPage)
      );
    },
    total() {
      return this.puntosAtencion.length;
    },
    filteredKeys() {
      return this.keys.filter((key) => key !== `Nombre`);
    },
    tituloFormularioReporte() {
      return this.formularioReporteIndex === -1
        ? "Formulario de reporte mensual"
        : "Formulario de reporte mensual";
    },
    personasInscritasTotal() {
      return this.obtenerTotalPersonasIncritas();
    },
    remisionesAEmpleadoresTotal() {
      return this.obtenerTotalRemisionesAEmpleadores();
    },
    colocadosTotal() {
      return this.obtenerTotalColocados();
    },
    personasAtendidas() {
      return this.obtenerTotalPersonasAtendidas();
    },
    personasAtendidasEnTalleres() {
      return this.obtenerTotalPersonasAtendidasEnTalleres();
    },
    remitidasFormacion() {
      return this.obtenerTotalPersonasRemitidasAFormacion();
    },
    remitidasFormacionHombres() {
      return this.obtenerTotalPersonasRemitidasAFormacionHombres();
    },
    remitidasFormacionMujeres() {
      return this.obtenerTotalPersonasRemitidasAFormacionMujeres();
    },
    culminaronFormacion() {
      return this.obtenerTotalPersonasQueCulminaronFormacion();
    },
    culminaronFormacionHombres() {
      return this.obtenerTotalPersonasQueCulminaronFormacionHombres();
    },
    culminaronFormacionMujeres() {
      return this.obtenerTotalPersonasQueCulminaronFormacionMujeres();
    },
    remitidasProgramasEmprendimiento() {
      return this.obtenerTotalPersonasRemitidasAEmprendimiento();
    },
  },
  watch: {
    dialog(val) {
      val || this.close();
    },
  },
  methods: {
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1;
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1;
    },
    updateItemsPerPage(number) {
      this.page = 1;
      this.itemsPerPage = number === "Todo" ? -1 : number;
    },
    ordenarPor(campo) {
      campo = campo === "código" ? "codigo" : campo;
      campo = campo === "departamento" ? "departamento.nombre" : campo;
      campo = campo === "municipio" ? "municipio.nombre" : campo;
      return campo;
    },
    obtenerTotalPersonasIncritas() {
      this.formularioReporte.personas_inscritas_total =
        (parseInt(this.formularioReporte.personas_inscritas_hombres) > 0
          ? parseInt(this.formularioReporte.personas_inscritas_hombres)
          : 0) +
        (parseInt(this.formularioReporte.personas_inscritas_mujeres) > 0
          ? parseInt(this.formularioReporte.personas_inscritas_mujeres)
          : 0);
      return this.formularioReporte.personas_inscritas_total;
    },
    obtenerTotalRemisionesAEmpleadores() {
      this.formularioReporte.remisiones_a_empleadores_total =
        (parseInt(this.formularioReporte.remisiones_a_empleadores_hombres) > 0
          ? parseInt(this.formularioReporte.remisiones_a_empleadores_hombres)
          : 0) +
        (parseInt(this.formularioReporte.remisiones_a_empleadores_mujeres) > 0
          ? parseInt(this.formularioReporte.remisiones_a_empleadores_mujeres)
          : 0);
      return this.formularioReporte.remisiones_a_empleadores_total;
    },
    obtenerTotalColocados() {
      this.formularioReporte.colocados_total =
        (parseInt(this.formularioReporte.colocados_hombres) > 0
          ? parseInt(this.formularioReporte.colocados_hombres)
          : 0) +
        (parseInt(this.formularioReporte.colocados_mujeres) > 0
          ? parseInt(this.formularioReporte.colocados_mujeres)
          : 0);
      return this.formularioReporte.colocados_total;
    },
    obtenerTotalPersonasAtendidas() {
      this.formularioReporte.personas_atendidas =
        (parseInt(this.formularioReporte.personas_atendidas_hombres) > 0
          ? parseInt(this.formularioReporte.personas_atendidas_hombres)
          : 0) +
        (parseInt(this.formularioReporte.personas_atendidas_mujeres) > 0
          ? parseInt(this.formularioReporte.personas_atendidas_mujeres)
          : 0);
      return this.formularioReporte.personas_atendidas;
    },
    obtenerTotalPersonasAtendidasEnTalleres() {
      this.formularioReporte.personas_atendidas_en_talleres =
        (parseInt(
          this.formularioReporte.personas_atendidas_en_talleres_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.personas_atendidas_en_talleres_hombres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.personas_atendidas_en_talleres_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.personas_atendidas_en_talleres_mujeres
            )
          : 0);
      return this.formularioReporte.personas_atendidas_en_talleres;
    },
    obtenerTotalPersonasRemitidasAFormacion() {
      this.formularioReporte.remitidas_formacion =
        this.obtenerTotalPersonasRemitidasAFormacionHombres() +
        this.obtenerTotalPersonasRemitidasAFormacionMujeres();
      return this.formularioReporte.remitidas_formacion;
    },
    obtenerTotalPersonasRemitidasAFormacionHombres() {
      this.formularioReporte.remitidas_formacion_hombres =
        (parseInt(
          this.formularioReporte.remitidas_formacion_competencias_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_competencias_hombres
            )
          : 0) +
        (parseInt(this.formularioReporte.remitidas_formacion_tic_hombres) > 0
          ? parseInt(this.formularioReporte.remitidas_formacion_tic_hombres)
          : 0) +
        (parseInt(
          this.formularioReporte.remitidas_formacion_alfabetizacion_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_alfabetizacion_hombres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.remitidas_formacion_entrenamiento_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_entrenamiento_hombres
            )
          : 0) +
        (parseInt(this.formularioReporte.remitidas_formacion_tecnico_hombres) >
        0
          ? parseInt(this.formularioReporte.remitidas_formacion_tecnico_hombres)
          : 0);
      return this.formularioReporte.remitidas_formacion_hombres;
    },
    obtenerTotalPersonasRemitidasAFormacionMujeres() {
      this.formularioReporte.remitidas_formacion_mujeres =
        (parseInt(
          this.formularioReporte.remitidas_formacion_competencias_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_competencias_mujeres
            )
          : 0) +
        (parseInt(this.formularioReporte.remitidas_formacion_tic_mujeres) > 0
          ? parseInt(this.formularioReporte.remitidas_formacion_tic_mujeres)
          : 0) +
        (parseInt(
          this.formularioReporte.remitidas_formacion_alfabetizacion_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_alfabetizacion_mujeres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.remitidas_formacion_entrenamiento_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_formacion_entrenamiento_mujeres
            )
          : 0) +
        (parseInt(this.formularioReporte.remitidas_formacion_tecnico_mujeres) >
        0
          ? parseInt(this.formularioReporte.remitidas_formacion_tecnico_mujeres)
          : 0);
      return this.formularioReporte.remitidas_formacion_mujeres;
    },
    obtenerTotalPersonasQueCulminaronFormacion() {
      this.formularioReporte.culminaron_formacion =
        this.obtenerTotalPersonasQueCulminaronFormacionHombres() +
        this.obtenerTotalPersonasQueCulminaronFormacionMujeres();
      return this.formularioReporte.culminaron_formacion;
    },
    obtenerTotalPersonasQueCulminaronFormacionHombres() {
      this.formularioReporte.culminaron_formacion_hombres =
        (parseInt(
          this.formularioReporte.culminaron_formacion_competencias_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_competencias_hombres
            )
          : 0) +
        (parseInt(this.formularioReporte.culminaron_formacion_tic_hombres) > 0
          ? parseInt(this.formularioReporte.culminaron_formacion_tic_hombres)
          : 0) +
        (parseInt(
          this.formularioReporte.culminaron_formacion_alfabetizacion_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_alfabetizacion_hombres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.culminaron_formacion_entrenamiento_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_entrenamiento_hombres
            )
          : 0) +
        (parseInt(this.formularioReporte.culminaron_formacion_tecnico_hombres) >
        0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_tecnico_hombres
            )
          : 0);
      return this.formularioReporte.culminaron_formacion_hombres;
    },
    obtenerTotalPersonasQueCulminaronFormacionMujeres() {
      this.formularioReporte.culminaron_formacion_mujeres =
        (parseInt(
          this.formularioReporte.culminaron_formacion_competencias_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_competencias_mujeres
            )
          : 0) +
        (parseInt(this.formularioReporte.culminaron_formacion_tic_mujeres) > 0
          ? parseInt(this.formularioReporte.culminaron_formacion_tic_mujeres)
          : 0) +
        (parseInt(
          this.formularioReporte.culminaron_formacion_alfabetizacion_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_alfabetizacion_mujeres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.culminaron_formacion_entrenamiento_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_entrenamiento_mujeres
            )
          : 0) +
        (parseInt(this.formularioReporte.culminaron_formacion_tecnico_mujeres) >
        0
          ? parseInt(
              this.formularioReporte.culminaron_formacion_tecnico_mujeres
            )
          : 0);
      return this.formularioReporte.culminaron_formacion_mujeres;
    },
    obtenerTotalPersonasRemitidasAEmprendimiento() {
      this.formularioReporte.remitidas_programas_emprendimiento =
        (parseInt(
          this.formularioReporte.remitidas_programas_emprendimiento_hombres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_programas_emprendimiento_hombres
            )
          : 0) +
        (parseInt(
          this.formularioReporte.remitidas_programas_emprendimiento_mujeres
        ) > 0
          ? parseInt(
              this.formularioReporte.remitidas_programas_emprendimiento_mujeres
            )
          : 0);
      return this.formularioReporte.remitidas_programas_emprendimiento;
    },
    cargarListado() {
      puntoAtencion
        .obtenerPuntosAtencion(this.periodo, this.prestador)
        .then((response) => {
          if (response.status === "success") {
            // this.procesando = false;
            // this.error = false;
            this.puntosAtencion = response.data;
            console.log(this.puntosAtencion);
          } else {
            // this.procesando = false;
            // this.error = true;
            console.log(response);
          }
        });
    },
    getColor(estado) {
      let color = "gray";

      switch (estado) {
        case "Pendiente":
          color = "orange";
          break;
        case "Reportado":
          color = "green";
          break;
        case "Incompleto":
          color = "lime";
          break;
        case "En proceso":
          color = "blue";
          break;
        case "Sin reporte":
          color = "red";
          break;
      }

      return color;
    },
    mostrarFormularioReporte(puntoAtencion) {
      this.puntoAtencionIndex = this.puntosAtencion.indexOf(puntoAtencion);
      this.puntoAtencion = Object.assign({}, puntoAtencion);
      this.modalFormularioReporte = true;
    },
    mostrarReporteDiligenciado(puntoAtencion) {
      reporte.obtenerReporte(puntoAtencion, this.periodo).then((response) => {
        if (response.status === "success") {
          // this.procesando = false;
          // this.error = false;
          this.puntoAtencionIndex = -1;
          this.puntoAtencion = Object.assign({}, puntoAtencion);
          if (response.data) {
            this.formularioReporte = response.data;
          }
          this.modalFormularioReporte = true;
        } else {
          // this.procesando = false;
          // this.error = true;
          console.log(response);
        }
      });
    },
    guardarFormularioReporte() {
      if (this.puntoAtencionIndex > -1) {
        reporte
          .guardarReporte(
            this.puntoAtencion,
            this.periodo,
            this.formularioReporte
          )
          .then((response) => {
            console.log(response.data);
            Object.assign(
              this.puntosAtencion[this.puntoAtencionIndex],
              response.data
            );
            this.cerrarFormularioReporte();
          })
          .catch((error) => {
            console.log(error);
            this.cerrarFormularioReporte();
          });

        Object.assign(
          this.puntosAtencion[this.puntoAtencionIndex],
          this.puntoAtencion
        );
      } else {
        this.cerrarFormularioReporte();
      }
    },
    scrollTopFormulario() {
      document.getElementsByClassName("v-dialog--active")[0].scrollTop = 0;
    },
    revisarFormulario() {
      this.scrollTopFormulario();
      this.pasoFormulario = 1;
    },
    cerrarFormularioReporte() {
      this.scrollTopFormulario();
      this.modalFormularioReporte = false;

      this.$nextTick(() => {
        this.formularioReporte = Object.assign(
          {},
          this.formularioReporteDefault
        );
        this.formularioReporteIndex = -1;
        this.pasoFormulario = 1;
      });
    },
  },
};
</script>
