<template>
  <div>
    <v-app id="inspire">
      <CCard>
        <CCardBody>
          <CRow>
            <CCol sm="5">
              <h4 class="card-title mb-0">Prestadores</h4>
              <div class="small text-muted">Listado</div>
            </CCol>
          </CRow>
          <CRow>
            <CCol sm="12">
              <v-toolbar color="blue-grey lighten-5" class="mb-1">
                <v-text-field
                  prepend-inner-icon="mdi-office-building"
                  label="Buscar prestador"
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
              <v-data-table
                :headers="headers"
                :page.sync="page"
                :items-per-page.sync="itemsPerPage"
                :items="prestadores"
                :sort-by="
                  sortBy.toLowerCase() === 'tipo'
                    ? 'tipo_prestador.descripcion'
                    : sortBy.toLowerCase()
                "
                :sort-desc="sortDesc"
                :search="search"
                loading-text="Cargando... Espere por favor"
                class="elevation-1"
                hide-default-footer
              >
                <template v-slot:[`header.id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.tipo_prestador_id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.nombre`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.estado`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>

                <template v-slot:item="{ item, index }">
                  <tr>
                    <td>{{ index + 1 + (page - 1) * 10 }}</td>
                    <td>{{ item.nombre.toUpperCase() }}</td>
                    <td>{{ item.tipo_prestador.descripcion.toUpperCase() }}</td>
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
                          <v-list-item @click="irListadoPuntosAtencion(item)">
                            <v-list-item-title
                              >Gestión Puntos de atención</v-list-item-title
                            >
                          </v-list-item>
                          <v-list-item @click="irListadoUsuarios(item)">
                            <v-list-item-title
                              >Gestión Usuarios</v-list-item-title
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
import router from "../router";

import prestador from "../services/prestador.js";

export default {
  name: "Prestadores",
  components: {},
  mounted() {
    this.vigencia = JSON.parse(sessionStorage.getItem("datosVigencia"));
    this.periodo = JSON.parse(sessionStorage.getItem("datosPeriodo"));

    this.cargarListado();
  },
  data() {
    return {
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      itemsPerPageArray: [10, 20, 50, 100, "Todo"],
      search: "",
      filter: {},
      sortDesc: false,
      sortBy: "nombre",
      keys: ["Nombre", "Tipo", "Estado"],
      vigencia: {},
      periodo: {},
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
          text: "Nombre",
          value: "nombre",
          sortable: false,
        },
        {
          text: "Tipo",
          value: "tipo_prestador_id",
          sortable: false,
        },
        {
          text: "Estado",
          value: "estado",
          sortable: false,
        },
      ],
      prestadores: [],
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(
        this.prestadores.length /
          (this.itemsPerPage === -1
            ? this.prestadores.length
            : this.itemsPerPage)
      );
    },
    total() {
      return this.prestadores.length;
    },
    filteredKeys() {
      return this.keys.filter((key) => key !== `Nombre`);
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
      prestador.obtenerPrestadores(this.periodo).then((response) => {
        if (response.status === "success") {
          this.prestadores = response.data;
        } else {
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
    irListadoPuntosAtencion(prestador) {
      sessionStorage.setItem("datosPrestador", JSON.stringify(prestador));

      router.push({
        name: "gestion-vigencias-prestadores-listado-puntos-atencion",
      });
    },
    irListadoUsuarios(prestador) {
      sessionStorage.setItem("datosPrestador", JSON.stringify(prestador));

      router.push({
        name: "gestion-vigencias-prestadores-listado-usuarios",
      });
    },
  },
};
</script>
