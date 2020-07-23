<template>
  <div>
    <v-app id="inspire">
      <v-dialog v-model="modalFormulario" persistent max-width="50%" style="z-index: 1040">
        <v-card>
          <v-card-title class="headline text-uppercase">Control de fechas</v-card-title>

          <v-card-subtitle class="text-justify">
            <br />Esta opción permite a los prestadores realizar el diligenciamiento del reporte mensual de estadísticas en un rango de fechas determinado.
            <br />
            <br />A continuación puede seleccionar el rango de fechas permitido para que los prestadores realicen el reporte de información mensual correspondiente al mes
            <strong>{{periodo.mes.valor_texto}}</strong> para la vigencia
            <strong>{{vigencia.nombre}}</strong>.
            <br />
            <v-form v-model="formularioControlFechasValido">
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

                      <v-date-picker v-model="periodo.fecha_fin" @input="menuFechaFin = false"></v-date-picker>
                    </v-menu>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </v-card-subtitle>

          <v-card-text></v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" @click="close" dark>Cancelar</v-btn>
            <v-btn
              color="green darken-1"
              @click="save"
              dark
              v-if="formularioControlFechasValido"
            >Guardar</v-btn>
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
                :items="vigencias"
                :items-per-page.sync="itemsPerPage"
                :page="page"
                :search="search"
                :sort-by="sortBy.toLowerCase()"
                :sort-desc="sortDesc"
                hide-default-footer
              >
                <template v-slot:header>
                  <v-toolbar dark color="light-blue lighten-1" class="mb-1">
                    <v-text-field
                      v-model="search"
                      clearable
                      flat
                      solo-inverted
                      hide-details
                      label="Buscar vigencia"
                    ></v-text-field>
                    <!-- prepend-inner-icon="search" -->
                    <template v-if="$vuetify.breakpoint.mdAndUp">
                      <v-spacer></v-spacer>
                      <v-select
                        v-model="sortBy"
                        flat
                        solo-inverted
                        hide-details
                        :items="keys"
                        label="Ordenar por"
                        v-show="false"
                      ></v-select>
                      <!-- prepend-inner-icon="search" -->
                      <v-spacer></v-spacer>
                      <v-btn-toggle v-model="sortDesc" mandatory v-show="true">
                        <v-btn large depressed color="light-blue darken-3" :value="false">
                          <v-icon>mdi-arrow-up</v-icon>
                        </v-btn>
                        <v-btn large depressed color="light-blue darken-3" :value="true">
                          <v-icon>mdi-arrow-down</v-icon>
                        </v-btn>
                      </v-btn-toggle>
                    </template>
                  </v-toolbar>
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
                        >{{ vigencia.nombre }}</v-card-title>

                        <v-divider></v-divider>

                        <v-list dense>
                          <v-list-item v-for="(periodo, i) in vigencia.periodos" :key="i">
                            <v-list-item-content>
                              <v-row>
                                <v-col cols="6">{{periodo.mes.valor_texto}}</v-col>
                                <v-col cols="6">
                                  <v-menu
                                    bottom
                                    origin="center center"
                                    transition="scale-transition"
                                  >
                                    <template v-slot:activator="{ on, attrs }">
                                      <v-chip
                                        v-show="periodo.estado_reporte.valor_texto !== 'No aplica'"
                                        :color="getColor(periodo.estado_reporte.valor_texto)"
                                        dark
                                        v-bind="attrs"
                                        v-on="on"
                                      >{{ periodo.estado_reporte.valor_texto }}</v-chip>
                                      <v-chip
                                        v-show="periodo.estado_reporte.valor_texto === 'No aplica'"
                                        :color="getColor(periodo.estado_reporte.valor_texto)"
                                        dark
                                      >{{ periodo.estado_reporte.valor_texto }}</v-chip>
                                    </template>

                                    <v-list>
                                      <v-list-item @click="editItem(vigencia, periodo)">
                                        <v-list-item-title>Control de Fechas</v-list-item-title>
                                      </v-list-item>
                                      <v-list-item @click="irListadoPrestadores()">
                                        <v-list-item-title>Reporte Mensual</v-list-item-title>
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
                        <v-btn dark text color="primary" class="ml-2" v-bind="attrs" v-on="on">
                          {{ itemsPerPage }}
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

                    <span class="mr-4 grey--text">Página {{ page }} de {{ numberOfPages }}</span>
                    <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">
                      <v-icon>mdi-chevron-left</v-icon>
                    </v-btn>
                    <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">
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

export default {
  name: "Vigencias",
  components: {},
  mounted() {
    this.cargarListado();
  },
  data() {
    return {
      itemsPerPageArray: [4, 8, 12, 16],
      search: "",
      filter: {},
      sortDesc: true,
      page: 1,
      itemsPerPage: 4,
      sortBy: "nombre",
      keys: ["Nombre"],
      modalFormulario: false,
      botonGuardar: true,
      periodoIndex: -1,
      periodo: {
        id: 0,
        fecha_inicio: "",
        fecha_fin: "",
        mes: { valor_texto: "" },
        estado_reporte: { valor_texto: "" }
      },
      periodoDefault: {
        id: 0,
        fecha_inicio: "",
        fecha_fin: "",
        mes: { valor_texto: "" },
        estado_reporte: { valor_texto: "" }
      },
      formularioControlFechasValido: false,
      menuFechaInicio: false,
      fechaInicioRules: [v => !!v || "Fecha inicio es requerida"],
      menuFechaFin: false,
      fechaFinRules: [
        v => !!v || "Fecha fin es requerida",
        v =>
          this.validarFechaFin(v) ||
          "La fecha fin debe ser superior a la fecha inicio"
      ],
      vigenciaIndex: -1,
      vigencias: [],
      vigencia: {}
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(this.vigencias.length / this.itemsPerPage);
    },
    filteredKeys() {
      return this.keys.filter(key => key !== `Nombre`);
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  methods: {
    cargarListado() {
      vigencia.obtenerVigencias().then(response => {
        if (response.status === "success") {
          // this.procesando = false;
          // this.error = false;
          this.vigencias = response.data;
        } else {
          // this.procesando = false;
          // this.error = true;
          console.log(response);
        }
      });
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
        case "Sin reporte":
          color = "red";
          break;
      }

      return color;
    },
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1;
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1;
    },
    updateItemsPerPage(number) {
      this.itemsPerPage = number;
    },
    editItem(vigencia, periodo) {
      this.vigenciaIndex = this.vigencias.indexOf(vigencia);
      this.periodoIndex = this.vigencias[this.vigenciaIndex].periodos.indexOf(
        periodo
      );

      this.vigencia = Object.assign({}, vigencia);
      this.periodo = Object.assign({}, periodo);
      this.modalFormulario = true;
    },
    save() {
      periodo
        .actualizarPeriodo(this.vigencia, this.periodo)
        .then(response => {
          this.vigencias[this.vigenciaIndex].periodos[this.periodoIndex].fecha_inicio = response.data.fecha_inicio;
          this.vigencias[this.vigenciaIndex].periodos[this.periodoIndex].fecha_fin = response.data.fecha_fin;
        })
        .catch(error => {
          console.log(error);
        });
      this.close();
    },
    close() {
      this.modalFormulario = false;
      this.$nextTick(() => {
        this.periodo = Object.assign({}, this.periodoDefault);
        this.VigenciaIndex = -1;
        this.PeriodoIndex = -1;
      });
    },
    irListadoPrestadores() {
      router.push({
        name: "gestion-vigencias-prestadores"
      });
    }
  }
};
</script>
