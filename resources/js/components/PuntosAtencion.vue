<template>
  <div>
    <v-app id="inspire">
      <v-dialog v-model="modalFormulario" persistent max-width="80%" style="z-index: 1040">
        <v-card>
          <v-card-title class="headline text-uppercase">Resolución 293 de 2017 - {{ formTitle }}</v-card-title>

          <v-card-subtitle>En cumplimiento de lo enunciado en la Resolución 293 de 2017, se dispone este formulario, en caso de inquietudes por favor leer las recomendaciones del recuadro azul, y para un desplazamiento más rápido entre los campos utilice la tecla de tabulación.</v-card-subtitle>

          <v-card-text>
            <v-stepper v-model="pasoFormulario" vertical>
              <v-stepper-step
                :complete="pasoFormulario > 1"
                step="1"
              >Número de Personas inscritas/registradas</v-stepper-step>
              <v-stepper-content step="1">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <small>Es el número de personas que registraron/inscribieron su hoja de vida en el sistema de información que le ha sido autorizado al prestador, de manera asistida por el Punto de Atención o autónoma (auto-registro de forma virtual), en el mes de referencia. Esta información debe presentarse desagregada por sexo: hombres y mujeres.</small>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 1">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 2">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 2"
                step="2"
              >Número de hojas de vida remitida a empleadores.</v-stepper-step>
              <v-stepper-content step="2">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Corresponde al número total de hojas de vida enviadas a empleadores para procesos de selección y/o contratación en el mes de referencia. Las remisiones de hojas de vida a empleadores comprenden los siguientes casos:</small>
                  </p>
                  <small>
                    <ol type="A">
                      <li>Cuando el Punto de Atención del prestador efectúa directamente el envío de las hojas de vida al empleador.</li>
                      <li>Cuando la persona inscrita/registrada se postula directamente a una vacante a través del sistema de información que le ha sido autorizado al prestador.</li>
                      <li>Cuando el empleador preselecciona directamente las hojas de vida a través del sistema de información que le ha sido autorizado al prestador.</li>
                    </ol>
                  </small>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 1">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 3">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 3" step="3">Número de personas colocadas</v-stepper-step>
              <v-stepper-content step="3">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Corresponde al número total de personas que fueron contratadas por el empleador como resultado de la gestión y validación realizada por el Punto de Atención, en el mes de referencia. Esta información debe presentarse desagregada por sexo: hombres y mujeres.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 2">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 4">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 4"
                step="4"
              >Número de personas colocadas con enfoque diferencial</v-stepper-step>
              <v-stepper-content step="4">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <small>
                    <ol type="A">
                      <li>
                        <strong>Colocaciones Victimas</strong>: Aquellas personas que individual o colectivamente hayan sufrido un daño por hechos ocurridos a partir del 1° de enero de 1985, como consecuencia de infracciones al Derecho Internacional Humanitario o de violaciones graves y manifiestas a las normas internacionales de Derechos Humanos, ocurridas con ocasión del conflicto armado interno (Ley 1448 de 2011).
                      </li>
                      <li>
                        <strong>Colocaciones Jóvenes</strong>: Personas con una edad menor o igual a 28 años.
                      </li>
                      <li>
                        <strong>Colocaciones con Discapacidad</strong>: Personas con condición de discapacidad auditiva, cognitiva o intelectual, física, psicosocial, sordoceguera o visual.
                      </li>
                    </ol>
                  </small>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Victimas"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Jóvenes"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Discapacidad"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 3">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 5">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 5"
                step="5"
              >Número de empleadores registrados/inscritos.</v-stepper-step>
              <v-stepper-content step="5">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Es el número de empleadores (personas jurídicas) que se registraron/ inscribieron en el sistema de información que le ha sido autorizado al prestador, de manera asistida por el Punto de Atención o autónoma (auto-registro de forma virtual), en el mes de referencia.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 4">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 6">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 6"
                step="6"
              >Número de personas atendidas en entrevista de orientación ocupacional.</v-stepper-step>
              <v-stepper-content step="6">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Corresponde al número de personas atendidas en entrevistas individuales con un orientador ocupacional, con el objetivo de identificar su perfil laboral y definir acciones que contribuyan a mejorar su empleabilidad. Esta información debe presentarse desagregada por sexo: hombres y mujeres.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 5">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 7">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 7"
                step="7"
              >Número de personas atendidas en actividades grupales de orientación ocupacional.</v-stepper-step>
              <v-stepper-content step="7">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Es el número de personas atendidas en actividades grupales, como talleres, en las cuales se brindan a los buscadores de empleo herramientas y asesoría para la búsqueda de empleo, identificación de alternativas laborales, herramientas para el autoempleo, información sobre programas de empleabilidad e información general del mercado laboral. Esta información debe presentarse desagregada por sexo: hombres y mujeres.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 6">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 8">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 8"
                step="8"
              >Número de personas direccionadas a programas de formación y capacitación para el trabajo.</v-stepper-step>
              <v-stepper-content step="8">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Hace referencia al número de personas que fueron direccionadas (preinscritos o inscritos) a cursos y/o programas, los cuales son ofrecidos directamente por el prestador o por entidades externas, relacionados con alguno de los siguientes tipos de formación, en el mes de referencia:</small>
                  </p>

                  <small>
                    <ol type="A">
                      <li>Formación en competencias claves y transversales.</li>
                      <li>Formación en Tecnologías de la Información y las Comunicaciones TIC.</li>
                      <li>Alfabetización o bachillerato.</li>
                      <li>Entrenamiento o reentrenamiento técnico.</li>
                      <li>Técnico laboral.</li>
                    </ol>
                  </small>

                  <p>
                    <small>Esta información debe presentarse desagregada para cada uno de los tipos de formación.</small>
                  </p>
                </v-alert>

                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>

                <v-container>
                  <v-alert color="blue lighten-2" border="top" elevation="2" colored-border>
                    <v-subheader class="blue--text text--lighten-2">
                      <strong>HOMBRES</strong>
                    </v-subheader>

                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Competencias claves transversales"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.fat"
                            label="Tecnologías de la Información y la Comunicaciones TIC"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.name"
                            label="Alfabetización o Bachillerato"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Entrenamiento o reentrenamiento técnico"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field v-model="editedItem.fat" label="Técnico laboral"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-alert>
                </v-container>

                <v-container>
                  <v-alert color="pink lighten-2" border="top" elevation="2" colored-border>
                    <v-subheader class="pink--text text--lighten-2">
                      <strong>MUJERES</strong>
                    </v-subheader>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Competencias claves transversales"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.fat"
                            label="Tecnologías de la Información y la Comunicaciones TIC"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.name"
                            label="Alfabetización o Bachillerato"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Entrenamiento o reentrenamiento técnico"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field v-model="editedItem.fat" label="Técnico laboral"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-alert>
                </v-container>

                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 7">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 9">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 9"
                step="9"
              >Número de personas direccionadas a programas de formación y capacitación para el trabajo.</v-stepper-step>
              <v-stepper-content step="9">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Hace referencia al número de personas que culminaron cursos y/o programas, los cuales son ofrecidos directamente por el prestador o por entidades externas, relacionados con alguno de los siguientes tipos de formación, en el mes de referencia:</small>
                  </p>

                  <small>
                    <ol type="A">
                      <li>Formación en competencias claves y transversales.</li>
                      <li>Formación en Tecnologías de la Información y las Comunicaciones TIC.</li>
                      <li>Alfabetización o bachillerato.</li>
                      <li>Entrenamiento o reentrenamiento técnico.</li>
                      <li>Técnico laboral.</li>
                    </ol>
                  </small>

                  <p>
                    <small>Esta información debe presentarse desagregada para cada uno de los tipos de formación.</small>
                  </p>
                </v-alert>

                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>

                <v-container>
                  <v-alert color="blue lighten-2" border="top" elevation="2" colored-border>
                    <v-subheader class="blue--text text--lighten-2">
                      <strong>HOMBRES</strong>
                    </v-subheader>

                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Competencias claves transversales"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.fat"
                            label="Tecnologías de la Información y la Comunicaciones TIC"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.name"
                            label="Alfabetización o Bachillerato"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Entrenamiento o reentrenamiento técnico"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field v-model="editedItem.fat" label="Técnico laboral"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-alert>
                </v-container>

                <v-container>
                  <v-alert color="pink lighten-2" border="top" elevation="2" colored-border>
                    <v-subheader class="pink--text text--lighten-2">
                      <strong>MUJERES</strong>
                    </v-subheader>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Competencias claves transversales"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.fat"
                            label="Tecnologías de la Información y la Comunicaciones TIC"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.name"
                            label="Alfabetización o Bachillerato"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field
                            v-model="editedItem.calories"
                            label="Entrenamiento o reentrenamiento técnico"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                          <v-text-field v-model="editedItem.fat" label="Técnico laboral"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-alert>
                </v-container>

                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 8">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 10">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 10"
                step="10"
              >Número de personas direccionadas a programas de emprendimiento</v-stepper-step>
              <v-stepper-content step="10">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Corresponde al número de personas direccionadas por el prestador a programas específicos de emprendimiento para personas que incursionan como emprendedores o que tienen experiencia en emprendimiento, los cuales son ofrecidos directamente por el prestador o por entidades externas, tales como programas que ofrecen capital semilla, líneas de financiamiento, asesoría en la estructuración de proyectos y orientación a emprendedores entre otros.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.calories" label="Hombres"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.fat" label="Mujeres"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 9">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 11">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step
                :complete="pasoFormulario > 11"
                step="11"
              >Número de PQRSD radicados en el Punto de Atención.</v-stepper-step>
              <v-stepper-content step="11">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>Corresponde al Número de PQRSD radicados en el Punto de Atención.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editedItem.name" label="TOTAL (*)"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 10">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 12">Siguiente</v-btn>
                </div>
              </v-stepper-content>

              <v-stepper-step :complete="pasoFormulario > 12" step="12">Observaciones</v-stepper-step>
              <v-stepper-content step="12">
                <v-alert icon="mdi-alert-octagon-outline" prominent text type="info">
                  <p>
                    <small>En el campo de observaciones por favor indiquenos en que aspectos podemos mejorar.</small>
                  </p>
                </v-alert>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="12" md="12">
                      <v-textarea counter label="Observaciones" v-model="editedItem.name"></v-textarea>
                      <!-- :rules="rules" :value="value" -->
                    </v-col>
                  </v-row>
                </v-container>
                <div style="display: flex; justify-content: space-around">
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 11">Anterior</v-btn>
                  <v-btn color="blue-grey lighten-1" @click="pasoFormulario = 13">Siguiente</v-btn>
                </div>
              </v-stepper-content>
            </v-stepper>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="close">Cancelar</v-btn>
            <v-btn color="blue darken-1" text @click="save">Guardar</v-btn>
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
                    <v-btn large depressed color="blue-grey lighten-1" :value="false">
                      <v-icon>mdi-arrow-up</v-icon>
                    </v-btn>
                    <v-btn large depressed color="blue-grey lighten-1" :value="true">
                      <v-icon>mdi-arrow-down</v-icon>
                    </v-btn>
                  </v-btn-toggle>
                </template>
              </v-toolbar>

              <br />
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
                <template v-slot:header.id="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.departamento_id="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.municipio_id="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.codigo="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.nombre="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.accion="{ header }">{{ header.text.toUpperCase() }}</template>

                <template v-slot:item="{ item, index }">
                  <tr>
                    <td>{{ index + 1 + (page-1)*10}}</td>
                    <td>{{ item.departamento.nombre.toUpperCase() }}</td>
                    <td>{{ item.municipio.nombre.toUpperCase() }}</td>
                    <td>{{ item.codigo.toUpperCase() }}</td>
                    <td>{{ item.nombre.toUpperCase() }}</td>
                    <td>
                      <v-menu bottom origin="center center" transition="scale-transition">
                        <template v-slot:activator="{ on, attrs }">
                          <v-chip
                            :color="getColor(item.estado)"
                            dark
                            v-bind="attrs"
                            v-on="on"
                          >{{item.estado}}</v-chip>
                        </template>
                        <v-list>
                          <v-list-item v-if="is('ROLE_PRESTADOR') && item.estado === 'En proceso'" @click="modalFormulario = true">
                            <v-list-item-title>Reporte Mensual</v-list-item-title>
                          </v-list-item>
                          <v-list-item @click="modalFormularioDiligenciado = true">
                            <v-list-item-title>Ver Reporte Diligenciado</v-list-item-title>
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
                  <v-btn color="warning" @click="cargarListado()">Recargar</v-btn>
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
                      {{ itemsPerPage === -1 ? 'Todo' : itemsPerPage }}
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
                <span
                  class="mr-4 grey--text"
                >Mostrando registros del {{ 1 + (page-1)*itemsPerPage }} al {{ itemsPerPage === -1 ? total : ( total > ((page-1)*itemsPerPage + itemsPerPage) ? ((page-1)*itemsPerPage + itemsPerPage) : total) }} de un total de {{ total }}</span>

                <v-spacer></v-spacer>
                <span class="mr-4 grey--text">Página {{ page }} de {{ numberOfPages }}</span>
                <v-btn fab dark color="blue-grey lighten-1" class="mr-1" @click="formerPage">
                  <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn fab dark color="blue-grey lighten-1" class="ml-1" @click="nextPage">
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
      modalFormulario: false,
      botonGuardar: true,
      pasoFormulario: 1,
      editedIndex: -1,
      editedItem: {
        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
      },
      defaultItem: {
        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0,
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
          text: "Estado",
          value: "estado",
          sortable: false,
        },
      ],
      puntosAtencion: [],
    };
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
    formTitle() {
      return this.editedIndex === -1
        ? "Formulario de reporte mensual"
        : "Formulario de reporte mensual";
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
    cargarListado() {
      puntoAtencion
        .obtenerPuntosAtencion(this.periodo, this.prestador)
        .then((response) => {
          if (response.status === "success") {
            // this.procesando = false;
            // this.error = false;
            this.puntosAtencion = response.data;
            // console.log(this.puntosAtencion);
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
    // editItem(item) {
    //   this.editedIndex = this.puntosAtencion.indexOf(item);
    //   this.editedItem = Object.assign({}, item);
    //   this.modalFormulario = true;
    // },
    save() {
      // if (this.editedIndex > -1) {
      //   Object.assign(this.desserts[this.editedIndex], this.editedItem);
      // } else {
      //   this.desserts.push(this.editedItem);
      // }
      this.close();
    },
    close() {
      this.modalFormulario = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
};
</script>
