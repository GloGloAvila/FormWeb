<template>
  <div>
    <v-app id="inspire">
      <v-dialog
        v-model="modalFormularioGestion"
        persistent
        max-width="80%"
        style="z-index: 1040"
      >
        <v-card>
          <v-card-title class="headline text-uppercase"
            >Gestión de funcionarios</v-card-title
          >

          <v-card-subtitle>{{ tituloFormularioGestion }}</v-card-subtitle>

          <v-card-text>
            <v-form v-model="formularioGestionValido">
              <v-container>
                <v-row>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Tipo funcionario"
                      v-model="formularioGestion.tipo_funcionario_id"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Correo electrónico"
                      v-model="formularioGestion.email"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Nombres"
                      v-model="formularioGestion.nombre"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Apellidos"
                      v-model="formularioGestion.apellido"
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Teléfono"
                      v-model="formularioGestion.telefono"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" md="6">
                    <v-text-field
                      label="Celular"
                      v-model="formularioGestion.celular"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" @click="cerrarFormularioGestion" dark
              >Cancelar</v-btn
            >
            <v-btn
              color="green darken-1"
              @click="guardarFormularioGestion"
              v-if="formularioGestionValido"
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
              <h4 class="card-title mb-0">Gestión de funcionarios</h4>
              <div class="small text-muted">Listado</div>
            </CCol>
          </CRow>
          <CRow>
            <CCol sm="12">
              <v-toolbar color="blue-grey lighten-5" class="mb-1">
                <v-text-field
                  prepend-inner-icon="mdi-office-building"
                  label="Buscar funcionario"
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
                    @click="modalFormularioGestion = true"
                    v-if="is('ROLE_ADMINISTRADOR')"
                  >
                    <v-icon>mdi-plus</v-icon>
                  </v-btn>
                </template>
              </v-toolbar>

              <br />

              <v-alert
                color="blue-grey lighten-1"
                dark
                icon="mdi-office-building"
                prominent
              >
                Listado de funcionarios del prestador
                <strong
                  >({{ prestador.migracion_id }}) {{ prestador.nombre }}</strong
                >
              </v-alert>

              <v-data-table
                :headers="headers"
                :items="funcionarios"
                :page.sync="page"
                :items-per-page.sync="itemsPerPage"
                :sort-by="ordenarPor(sortBy.toLowerCase())"
                :sort-desc="sortDesc"
                :search="search"
                class="elevation-1"
                hide-default-footer
              >
                <template v-slot:[`header.id`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.tipo_funcionario`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.full_name`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.email`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.telefono`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>
                <template v-slot:[`header.accion`]="{ header }">{{
                  header.text.toUpperCase()
                }}</template>

                <template v-slot:item="{ item, index }">
                  <tr>
                    <td>{{ index + 1 + (page - 1) * 10 }}</td>
                    <td>
                      {{
                        item.tipo_funcionario.valor_texto
                          ? item.tipo_funcionario.valor_texto.toUpperCase()
                          : ""
                      }}
                    </td>
                    <td>
                      {{ item.full_name ? item.full_name.toUpperCase() : "" }}
                    </td>
                    <td>
                      <v-chip
                        class="ma-2"
                        color="indigo darken-3"
                        outlined
                        small
                        v-if="item.email"
                      >
                        <v-icon left small> mdi-email </v-icon>
                        {{ item.email ? item.email.toLowerCase() : "" }}
                      </v-chip>
                      <br />
                      <v-chip
                        class="ma-2"
                        color="indigo darken-3"
                        outlined
                        small
                        v-if="item.telefono"
                      >
                        <v-icon left small> mdi-phone </v-icon>
                        {{ item.telefono }}
                      </v-chip>
                      <br />
                      <v-chip
                        class="ma-2"
                        color="indigo darken-3"
                        outlined
                        small
                        v-if="item.celular"
                      >
                        <v-icon left small> mdi-cellphone-iphone </v-icon>
                        {{ item.celular }}
                      </v-chip>
                    </td>
                    <td></td>
                    <td>
                      <v-menu
                        bottom
                        origin="center center"
                        transition="scale-transition"
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-chip color="green" dark v-bind="attrs" v-on="on"
                            >Gestionar</v-chip
                          >
                        </template>
                        <v-list>
                          <v-list-item @click="mostrarFormularioGestion(item)">
                            <v-list-item-title>
                              <v-btn small text> Modificar </v-btn>
                            </v-list-item-title>
                          </v-list-item>
                          <v-list-item
                            @click="mostrarConfirmacionBorrado(item)"
                          >
                            <v-list-item-title>
                              <v-menu offset-x>
                                <template
                                  v-slot:activator="{ subOn, subAttrs }"
                                >
                                  <v-menu
                                    v-model="ModalMenuEliminar"
                                    :close-on-content-click="false"
                                    :nudge-width="200"
                                    v-on="subOn"
                                    v-bind="subAttrs"
                                    offset-x
                                  >
                                    <template v-slot:activator="{ on, attrs }">
                                      <v-btn
                                        text
                                        small
                                        v-bind="attrs"
                                        v-on="on"
                                      >
                                        Eliminar
                                      </v-btn>
                                    </template>
                                    <v-card max-width="350">
                                      <v-list>
                                        <v-list-item>
                                          <v-list-item-avatar>
                                            <v-icon left> mdi-delete </v-icon>
                                          </v-list-item-avatar>

                                          <v-list-item-content>
                                            <v-list-item-title
                                              >Eliminar
                                              funcionario</v-list-item-title
                                            >
                                            <v-list-item-subtitle
                                              >¿Está seguro de eliminar este
                                              registro?</v-list-item-subtitle
                                            >
                                          </v-list-item-content>
                                        </v-list-item>
                                      </v-list>

                                      <v-divider></v-divider>

                                      <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                          text
                                          @click="ModalMenuEliminar = false"
                                        >
                                          No
                                        </v-btn>
                                        <v-btn
                                          color="primary"
                                          text
                                          @click="ModalMenuEliminar = false"
                                        >
                                          Sí
                                        </v-btn>
                                      </v-card-actions>
                                    </v-card>
                                  </v-menu>
                                </template>
                              </v-menu>
                            </v-list-item-title>
                          </v-list-item>
                        </v-list>
                      </v-menu>
                    </td>
                  </tr>
                </template>

                <template v-slot:no-data>
                  <div v-if="loading">
                    <v-text-field
                      color="success"
                      loading
                      disabled
                    ></v-text-field>
                    <small>
                      Cargando listado de usuarios, por favor espere...
                      <br />
                      <br />
                    </small>
                  </div>

                  <div v-if="!loading">
                    <br />
                    <br />No tiene información registrada.
                    <br />
                    <br />
                    <v-btn color="warning" @click="cargarListado()"
                      >Recargar</v-btn
                    >
                    <br />
                    <br />
                  </div>
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
import funcionario from "../services/funcionario.js";
import tipoFuncionario from "../services/tipoFuncionario.js";

export default {
  name: "Funcionarios",
  components: {},
  mounted() {
    this.prestador = JSON.parse(sessionStorage.getItem("datosPrestador"));

    this.cargarListado();
  },
  data() {
    return {
      loading: true,
      page: 1,
      pageCount: 0,
      itemsPerPage: 10,
      itemsPerPageArray: [5, 10, 15, 20, "Todo"],
      search: "",
      filter: {},
      sortDesc: false,
      sortBy: "nombre",
      keys: ["Nombre", "Correo"],
      prestador: {},
      modalFormularioGestion: false,
      botonGuardar: true,
      ModalMenuEliminar: false,
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
      formularioGestionValido: false,
      formularioGestionIndex: -1,
      formularioGestion: {
        tipo_funcionario_id: 0,
        nombre: "",
        apellido: "",
        email: "",
        telefono: "",
        celular: "",
      },
      formularioGestionDefault: {
        tipo_funcionario_id: 0,
        nombre: "",
        apellido: "",
        email: "",
        telefono: "",
        celular: "",
      },
      headers: [
        {
          text: "Consecutivo",
          value: "id",
          sortable: false,
        },
        {
          text: "Tipo funcionario",
          value: "tipo_funcionario",
          sortable: false,
        },
        {
          text: "Nombre",
          value: "full_name",
          sortable: false,
        },
        {
          text: "Contacto",
          value: "email",
          sortable: false,
        },
        {
          text: "Puntos atención",
          value: "telefono",
          sortable: false,
        },
        {
          text: "Acciones",
          value: "accion",
          sortable: false,
        },
      ],
      funcionarios: [],
      tiposFuncionarios: [],
    };
  },
  computed: {
    numberOfPages() {
      return Math.ceil(
        this.funcionarios.length /
          (this.itemsPerPage === -1
            ? this.funcionarios.length
            : this.itemsPerPage)
      );
    },
    total() {
      return this.funcionarios.length;
    },
    filteredKeys() {
      return this.keys.filter((key) => key !== `Nombre`);
    },
    tituloFormularioGestion() {
      return this.formularioGestionIndex === -1
        ? "Formulario de creación"
        : "Formulario de modificación";
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
      campo = campo === "correo" ? "email" : campo;
      return campo;
    },
    cargarListado() {
      const funcionarios = funcionario.obtenerFuncionarios(this.prestador);
      const tiposFuncionarios = tipoFuncionario.obtenerTiposFuncionario();

      this.loading = true;

      Promise.all([funcionarios, tiposFuncionarios]).then((response) => {
        const funcionarios = response[0];
        const tiposFuncionarios = response[1];

        this.loading = false;

        if (funcionarios.status === "success") {
          this.funcionarios = funcionarios.data;
          if (this.funcionarios.length) {
            console.log(this.prestador);
          }
          console.log(this.funcionarios);
        } else {
          console.log(funcionarios);
        }

        if (tiposFuncionarios.status === "success") {
          this.tiposFuncionarios = tiposFuncionarios.data;
          console.log(this.tiposFuncionarios);
        } else {
          console.log(tiposFuncionarios);
        }
      });
    },
    mostrarFormularioGestion(funcionario) {
      this.obtenerDatosFormularioGestion(funcionario);
      this.modalFormularioGestion = true;
    },
    mostrarConfirmacionBorrado(funcionario) {
      this.obtenerDatosFormularioGestion(funcionario);
      this.modalMostrarConfirmacionBorrado = true;
    },
    obtenerDatosFormularioGestion(funcionario) {
      this.formularioGestionIndex = this.funcionarios.indexOf(funcionario);
      this.formularioGestion = Object.assign({}, funcionario);
    },
    guardarFormularioGestion() {
      if (this.formularioGestionIndex > -1) {
        this.update();
      } else {
        this.create();
      }
    },
    create() {
      funcionario
        .crearFuncionario(this.prestador, this.formularioGestion)
        .then((response) => {
          this.resetForm();
          this.cerrarFormularioGestion();
        });
    },
    update() {
      funcionario
        .editarFuncionario(this.prestador, this.formularioGestion)
        .then((response) => {
          console.log(response);
          console.log(this.formularioGestion);
          Object.assign(
            this.funcionarios[this.formularioGestionIndex],
            this.formularioGestion
          );

          this.resetForm();
          this.cerrarFormularioGestion();
        });
    },
    resetForm() {
      this.formularioGestionIndex = -1;
      this.formularioGestion = { ...this.formularioGestionDefault };
    },
    cerrarFormularioGestion() {
      this.modalFormularioGestion = false;

      this.$nextTick(() => {
        this.formularioGestion = Object.assign(
          {},
          this.formularioGestionDefault
        );
        this.formularioGestionIndex = -1;
      });
    },
  },
};
</script>
