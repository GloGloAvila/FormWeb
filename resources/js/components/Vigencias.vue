<template>
  <div>
    <v-app id="inspire">
      <v-dialog
        v-model="modalFormularioPeriodo"
        persistent
        max-width="50%"
        style="z-index: 1040"
      >
        <v-card>
          <v-card-title class="headline text-uppercase"
            >Control de fechas</v-card-title
          >

          <v-card-subtitle class="text-justify">
            <br />Esta opción permite a los prestadores realizar el
            diligenciamiento del reporte mensual de estadísticas en un rango de
            fechas determinado.
            <br />
            <br />A continuación puede seleccionar el rango de fechas permitido
            para que los prestadores realicen el reporte de información mensual
            correspondiente al mes
            <strong>{{ periodo.mes.valor_texto }}</strong> para la vigencia
            <strong>{{ vigencia.nombre }}</strong
            >.
            <br />
            <v-form ref="formularioPeriodo">
              <!-- lazy-validation -->
              <v-container>
                <v-row>
                  <v-col cols="12" md="6">
                    <v-menu
                      v-model="menuFechaInicio"
                      :close-on-content-click="false"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="periodo.fecha_inicio"
                          :rules="fechaInicioRules"
                          prepend-icon="mdi-calendar"
                          label="Fecha inicio"
                          v-on="on"
                          v-bind="attrs"
                          readonly
                        ></v-text-field>
                      </template>

                      <v-date-picker
                        v-model="periodo.fecha_inicio"
                        @input="menuFechaInicio = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>

                  <v-col cols="12" md="6">
                    <v-menu
                      v-model="menuFechaFin"
                      :close-on-content-click="false"
                      transition="scale-transition"
                      offset-y
                      min-width="290px"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="periodo.fecha_fin"
                          :rules="fechaFinRules"
                          prepend-icon="mdi-calendar"
                          label="Fecha fin"
                          v-on="on"
                          v-bind="attrs"
                          readonly
                        ></v-text-field>
                      </template>

                      <v-date-picker
                        v-model="periodo.fecha_fin"
                        @input="menuFechaFin = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </v-card-subtitle>

          <v-card-text></v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" @click="cerrarFormularioPeriodo" dark
              >Cancelar</v-btn
            >
            <v-btn
              color="green darken-1"
              @click="guardarPeriodo"
              dark
              v-if="formularioPeriodoValido"
              >Guardar</v-btn
            >
            <v-btn color="gray darken-1" disabled v-else>Guardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog
        v-model="modalFormularioVigencia"
        persistent
        max-width="50%"
        style="z-index: 1040"
      >
        <v-card>
          <v-card-title class="headline text-uppercase"
            >Gestión de vigencias</v-card-title
          >

          <v-card-subtitle class="text-justify">
            <br />
            A continuación ingrese el año de la vigencia a
            {{ accion.toLowerCase() }} en formato YYYY. Ejemplo: 1981
            <br />
            <v-form v-model="formularioVigenciaValido">
              <v-container>
                <v-row>
                  <v-col cols="12" md="12">
                    <v-text-field
                      label="Vigencia"
                      v-model="vigencia.nombre"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </v-card-subtitle>

          <v-card-text></v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" @click="cerrarFormularioVigencia" dark
              >Cancelar</v-btn
            >
            <v-btn
              color="green darken-1"
              @click="guardarVigencia"
              dark
              v-if="formularioVigenciaValido"
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
              <h4 class="card-title mb-0">Vigencias</h4>
              <div class="small text-muted">Listado</div>
            </CCol>
          </CRow>
          <CRow>
            <CCol sm="12">
              <v-data-iterator
                loading
                loading-text=""
                :items-per-page.sync="itemsPerPage"
                :sort-by="sortBy.toLowerCase()"
                :sort-desc="sortDesc"
                hide-default-footer
                :items="vigencias"
                :search="search"
                :page="page"
              >
                <template v-slot:header>
                  <v-toolbar color="blue-grey lighten-5" class="mb-1">
                    <v-text-field
                      prepend-inner-icon="mdi-calendar-search"
                      label="Buscar vigencia"
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
                      <v-spacer v-if="is('ROLE_ADMINISTRADOR')"></v-spacer>
                      <v-btn
                        large
                        depressed
                        color="green lighten-1"
                        @click="modalFormularioVigencia = true"
                        v-if="is('ROLE_ADMINISTRADOR')"
                      >
                        <v-icon>mdi-plus</v-icon>
                      </v-btn>
                    </template>
                  </v-toolbar>
                  <div v-if="loading" class="text-center grey--text">
                    <v-text-field
                      color="success"
                      loading
                      disabled
                    ></v-text-field>
                    <small>
                      Cargando listado de vigencias y periodos, por favor
                      espere...
                      <br />
                      <br />
                    </small>
                  </div>
                </template>

                <template v-slot:default="props">
                  <v-row>
                    <v-col
                      v-for="vigencia in props.items"
                      :key="vigencia.nombre"
                      cols="12"
                      sm="6"
                      md="4"
                      lg="3"
                    >
                      <v-card>
                        <v-card-title
                          class="subheading font-weight-bold justify-center"
                        >
                          {{ vigencia.nombre }}
                          <v-spacer v-if="is('ROLE_ADMINISTRADOR')"></v-spacer>
                          <v-btn
                            v-if="is('ROLE_ADMINISTRADOR')"
                            icon
                            @click="editarVigencia(vigencia)"
                          >
                            <v-icon>mdi-pencil</v-icon>
                          </v-btn>
                        </v-card-title>

                        <v-divider></v-divider>

                        <v-list dense>
                          <v-list-item
                            v-for="(periodo, i) in vigencia.periodos"
                            :key="i"
                          >
                            <v-list-item-content>
                              <v-row>
                                <v-col cols="6">{{
                                  periodo.mes.valor_texto
                                }}</v-col>
                                <v-col cols="6">
                                  <v-menu
                                    bottom
                                    origin="center center"
                                    transition="scale-transition"
                                  >
                                    <template v-slot:activator="{ on, attrs }">
                                      <v-chip
                                        v-show="periodo.estado !== 'No aplica'"
                                        :color="getColor(periodo.estado)"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                        >{{ periodo.estado }}</v-chip
                                      >
                                      <v-chip
                                        v-show="periodo.estado === 'No aplica'"
                                        :color="getColor(periodo.estado)"
                                        dark
                                        >{{ periodo.estado }}</v-chip
                                      >
                                    </template>

                                    <v-list>
                                      <v-list-item
                                        v-if="is('ROLE_ADMINISTRADOR')"
                                        @click="
                                          editarPeriodo(vigencia, periodo)
                                        "
                                      >
                                        <v-list-item-title>
                                          <v-btn small text>
                                            Control de Fechas
                                          </v-btn>
                                        </v-list-item-title>
                                      </v-list-item>
                                      <v-list-item
                                        v-if="is('ROLE_ADMINISTRADOR')"
                                        :href="generarReporteMensual(periodo)"
                                        style="text-decoration:none"
                                      >
                                        <v-list-item-title>
                                          <v-btn small text>
                                            Reporte mensual
                                          </v-btn>
                                        </v-list-item-title>
                                      </v-list-item>
                                      <v-list-item
                                        v-if="is('ROLE_ADMINISTRADOR_UNO')"
                                        @click="
                                          generarReportePuntosAtencionPendientes(
                                            vigencia,
                                            periodo
                                          )
                                        "
                                      >
                                        <v-list-item-title>
                                          <v-btn small text>
                                            Reporte puntos atención pendientes
                                          </v-btn>
                                        </v-list-item-title>
                                      </v-list-item>
                                      <v-list-item
                                        @click="
                                          irListadoPrestadores(
                                            vigencia,
                                            periodo
                                          )
                                        "
                                      >
                                        <v-list-item-title>
                                          <v-btn small text>
                                            Gestión Prestadores
                                          </v-btn>
                                        </v-list-item-title>
                                      </v-list-item>
                                    </v-list>
                                  </v-menu>
                                </v-col>
                              </v-row>
                            </v-list-item-content>
                          </v-list-item>
                        </v-list>
                      </v-card>
                    </v-col>
                  </v-row>
                </template>

                <template v-slot:footer>
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
                </template>
              </v-data-iterator>
            </CCol>
          </CRow>
        </CCardBody>
      </CCard>
    </v-app>
  </div>
</template>

<script>
import router from "../router";

import vigencia from "../services/vigencia.js";
import periodo from "../services/periodo.js";
import reporte from "../services/reporte.js";

export default {
  name: "Vigencias",
  components: {},
  mounted() {
    this.cargarListado();
  },
  data() {
    return {
      loading: true,
      itemsPerPageArray: [4, 8, 12, 16, "Todo"],
      search: "",
      filter: {},
      sortDesc: true,
      page: 1,
      itemsPerPage: 4,
      sortBy: "nombre",
      keys: ["Nombre"],
      modalFormularioPeriodo: false,
      periodoIndex: -1,
      periodo: {
        id: 0,
        fecha_inicio: "",
        fecha_fin: "",
        mes: { valor_texto: "" },
        estado: "",
      },
      periodoDefault: {
        id: 0,
        fecha_inicio: "",
        fecha_fin: "",
        mes: { valor_texto: "" },
        estado: "",
      },
      menuFechaInicio: false,
      fechaInicioRules: [
        (v) => !!v || "Fecha inicio es requerida",
        (v) =>
          (v && this.validarFechaInicio(v)) ||
          "La fecha inicio debe ser inferior a la fecha fin",
      ],
      menuFechaFin: false,
      fechaFinRules: [
        (v) => !!v || "Fecha fin es requerida",
        (v) =>
          (v && this.validarFechaFin(v)) ||
          "La fecha fin debe ser superior a la fecha inicio",
      ],
      modalFormularioVigencia: false,
      formularioVigenciaValido: false,
      vigenciaIndex: -1,
      vigencia: {
        id: 0,
        nombre: "",
      },
      vigenciaDefault: {
        id: 0,
        nombre: "",
      },
      vigencias: [],
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(this.vigencias.length / this.itemsPerPage);
    },
    total() {
      return this.vigencias.length;
    },
    filteredKeys() {
      return this.keys.filter((key) => key !== `Nombre`);
    },
    accion() {
      return this.vigenciaIndex === -1 ? "Crear" : "Editar";
    },
    formularioPeriodoValido() {
      if (this.$refs.formularioPeriodo) {
        this.$refs.formularioPeriodo.validate();
      }
      return (
        this.validarFechaInicio(this.periodo.fecha_inicio) &&
        this.validarFechaFin(this.periodo.fecha_fin)
      );
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
    cargarListado() {
      this.loading = true;
      vigencia.obtenerVigencias().then((response) => {
        this.loading = false;
        if (response.status === "success") {
          this.vigencias = response.data;
        } else {
          console.log(response);
        }
      });
    },
    validarFechaInicio(fechaInicio) {
      return fechaInicio <= this.periodo.fecha_fin;
    },
    validarFechaFin(fechaFin) {
      return fechaFin >= this.periodo.fecha_inicio;
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
    editarVigencia(vigencia) {
      this.vigenciaIndex = this.vigencias.indexOf(vigencia);
      this.vigencia = Object.assign({}, vigencia);
      this.modalFormularioVigencia = true;
    },
    guardarVigencia() {
      if (this.vigenciaIndex > -1) {
        // Script para editar vigencia, al ser exitoso la edición se debe asignar al arreglo de vigencias
        vigencia
          .actualizarVigencia(this.vigencia)
          .then((response) => {
            Object.assign(this.vigencias[this.vigenciaIndex], response.data);
            this.cerrarFormularioVigencia();
          })
          .catch((error) => {
            console.log(error);
            this.cerrarFormularioVigencia();
          });
      } else {
        // Script para crear vigencia, al ser exitosa la creación se debe agregar al arreglo de vigencias
        vigencia
          .crearVigencia(this.vigencia)
          .then((response) => {
            console.log(response.data);
            this.vigencias.push(response.data);
            this.cerrarFormularioVigencia();
          })
          .catch((error) => {
            console.log(error);
            this.cerrarFormularioVigencia();
          });
      }
    },
    cerrarFormularioVigencia() {
      this.modalFormularioVigencia = false;
      this.$nextTick(() => {
        this.resetearObjetos();
      });
    },
    editarPeriodo(vigencia, periodo) {
      this.vigenciaIndex = this.vigencias.indexOf(vigencia);
      this.periodoIndex = this.vigencias[this.vigenciaIndex].periodos.indexOf(
        periodo
      );

      this.vigencia = Object.assign({}, vigencia);
      this.periodo = Object.assign({}, periodo);
      this.modalFormularioPeriodo = true;
    },
    guardarPeriodo() {
      periodo
        .actualizarPeriodo(this.vigencia, this.periodo)
        .then((response) => {
          Object.assign(
            this.vigencias[this.vigenciaIndex].periodos[this.periodoIndex],
            response.data
          );
          this.cerrarFormularioPeriodo();
        })
        .catch((error) => {
          console.log(error);
          this.cerrarFormularioPeriodo();
        });
    },
    generarReporteMensual(periodo) {
      return reporte.obtenerReporteMensual(periodo);
    },
    generarReportePuntosAtencionPendientes() {},
    cerrarFormularioPeriodo() {
      this.modalFormularioPeriodo = false;
      this.$nextTick(() => {
        this.resetearObjetos();
      });
    },
    resetearObjetos() {
      this.vigencia = Object.assign({}, this.vigenciaDefault);
      this.periodo = Object.assign({}, this.periodoDefault);
      this.vigenciaIndex = -1;
      this.periodoIndex = -1;
    },
    irListadoPrestadores(vigencia, periodo) {
      sessionStorage.setItem("datosVigencia", JSON.stringify(vigencia));
      sessionStorage.setItem("datosPeriodo", JSON.stringify(periodo));

      router.push({
        name: "gestion-vigencias-prestadores",
      });
    },
  },
};
</script>
