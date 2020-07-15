<template>
  <div>
    <v-app id="inspire">
      <v-dialog v-model="modalFormulario" persistent max-width="50%" style="z-index: 1040">
        <v-card>
          <v-card-title class="headline text-uppercase">Control de fechas</v-card-title>

          <v-card-subtitle>Esta opción permite a los prestadores el reporte mensual de estadísticas en un rango de fechas determinado. A continuación puede seleccionar el rango de fechas permitido para que los prestadores realicen el repote correspondiente al mes {{editedItem.mes}} para la vigencia {{vigencia.nombre}}.</v-card-subtitle>

          <v-card-text></v-card-text>

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
                                <v-col cols="6">{{periodo.mes}}</v-col>
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
                                      >{{ periodo.estado }}</v-chip>
                                      <v-chip
                                        v-show="periodo.estado === 'No aplica'"
                                        :color="getColor(periodo.estado)"
                                        dark
                                      >{{ periodo.estado }}</v-chip>
                                    </template>

                                    <v-list>
                                      <v-list-item @click="editItem(vigencia, periodo)">
                                        <v-list-item-title>Control de Fechas</v-list-item-title>
                                      </v-list-item>
                                      <v-list-item @click="listadoPuntosAtencion()">
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

import router from '../router'

export default {
  name: "Vigencias",
  components: {},
  mounted() {
    this.cargarListado();
  },
  data() {
    return {
      itemsPerPageArray: [4, 8],
      search: "",
      filter: {},
      sortDesc: true,
      page: 1,
      itemsPerPage: 4,
      sortBy: "nombre",
      keys: ["Nombre"],
      modalFormulario: false,
      botonGuardar: true,
      editedIndex: -1,
      editedItem: {
        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },      
      defaultItem: {
        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
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
      this.vigencias = [
        {
          id: 3,
          nombre: "2020",
          periodos: [
            {
              id: 1,
              mes: "Enero",
              estado: "Pendiente"
            },
            {
              id: 2,
              mes: "Febrero",
              estado: "Pendiente"
            },
            {
              id: 3,
              mes: "Abril",
              estado: "Pendiente"
            },
            {
              id: 4,
              mes: "Mayo",
              estado: "Pendiente"
            },
            {
              id: 5,
              mes: "Junio",
              estado: "Pendiente"
            },
            {
              id: 6,
              mes: "Junio",
              estado: "Pendiente"
            },
            {
              id: 7,
              mes: "Julio",
              estado: "Pendiente"
            },
            {
              id: 8,
              mes: "Agosto",
              estado: "Pendiente"
            },
            {
              id: 9,
              mes: "Septiembre",
              estado: "Pendiente"
            },
            {
              id: 10,
              mes: "Octubre",
              estado: "Pendiente"
            },
            {
              id: 11,
              mes: "Noviembre",
              estado: "Pendiente"
            },
            {
              id: 12,
              mes: "Diciembre",
              estado: "Pendiente"
            }
          ]
        },
        {
          id: 2,
          nombre: "2019",
          periodos: [
            {
              id: 1,
              mes: "Enero",
              estado: "Pendiente"
            },
            {
              id: 2,
              mes: "Febrero",
              estado: "Pendiente"
            },
            {
              id: 3,
              mes: "Abril",
              estado: "Pendiente"
            },
            {
              id: 4,
              mes: "Mayo",
              estado: "Pendiente"
            },
            {
              id: 5,
              mes: "Junio",
              estado: "Pendiente"
            },
            {
              id: 6,
              mes: "Junio",
              estado: "Pendiente"
            },
            {
              id: 7,
              mes: "Julio",
              estado: "Pendiente"
            },
            {
              id: 8,
              mes: "Agosto",
              estado: "Pendiente"
            },
            {
              id: 9,
              mes: "Septiembre",
              estado: "Pendiente"
            },
            {
              id: 10,
              mes: "Octubre",
              estado: "Pendiente"
            },
            {
              id: 11,
              mes: "Noviembre",
              estado: "Pendiente"
            },
            {
              id: 12,
              mes: "Diciembre",
              estado: "Pendiente"
            }
          ]
        },
        {
          id: 1,
          nombre: "2018",
          periodos: [
            {
              id: 1,
              mes: "Enero",
              estado: "No aplica"
            },
            {
              id: 2,
              mes: "Febrero",
              estado: "No aplica"
            },
            {
              id: 3,
              mes: "Abril",
              estado: "No aplica"
            },
            {
              id: 4,
              mes: "Mayo",
              estado: "No aplica"
            },
            {
              id: 5,
              mes: "Junio",
              estado: "No aplica"
            },
            {
              id: 6,
              mes: "Junio",
              estado: "No aplica"
            },
            {
              id: 7,
              mes: "Julio",
              estado: "No aplica"
            },
            {
              id: 8,
              mes: "Agosto",
              estado: "No aplica"
            },
            {
              id: 9,
              mes: "Septiembre",
              estado: "No aplica"
            },
            {
              id: 10,
              mes: "Octubre",
              estado: "No aplica"
            },
            {
              id: 11,
              mes: "Noviembre",
              estado: "No aplica"
            },
            {
              id: 12,
              mes: "Diciembre",
              estado: "Pendiente"
            }
          ]
        }
      ];
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
      // this.editedIndex = this.puntosAtencion.indexOf(item);
      this.vigencia = Object.assign({}, vigencia);
      this.editedItem = Object.assign({}, periodo);
      this.modalFormulario = true;
    },
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
    listadoPuntosAtencion() {
      router.push({
        name: "gestion-vigencias-listado-puntos-atencion"
      });
    }
  }
};
</script>
