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
              <v-data-table :headers="headers" :items="prestadores" class="elevation-1">
                <template v-slot:header.id="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.tipo_prestador="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.prestador="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.accion="{ header }">{{ header.text.toUpperCase() }}</template>

                <template v-slot:item="{ item, index }">
                  <tr>
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.tipo_prestador }}</td>
                    <td>{{ item.prestador }}</td>
                    <td>
                      <v-chip
                        color="blue"
                        dark
                        @click="irListadoPuntosAtencion()"
                      >Puntos de Atención</v-chip>
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
  name: "Prestadores",
  components: {},
  mounted() {
    this.cargarListado();
  },
  data() {
    return {
      modalFormulario: false,
      botonGuardar: true,
      pasoFormulario: 1,
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
      headers: [
        {
          text: "Consecutivo",
          value: "id",
          sortable: false
        },
        {
          text: "Tipo prestador",
          value: "tipo_prestador",
          sortable: false
        },
        {
          text: "Prestador",
          value: "prestador",
          sortable: false
        },
        {
          text: "Acciones",
          value: "accion",
          sortable: false
        }
      ],
      prestadores: []
    };
  },
  computed: {},
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  methods: {
    cargarListado() {
      this.prestadores = [
        {
          id: "001",
          tipo_prestador: "Bolsa de empleo",
          prestador: "ADECCO"
        }
      ];
    },
    editItem(item) {
      this.editedIndex = this.puntosAtencion.indexOf(item);
      this.editedItem = Object.assign({}, item);
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
    irListadoPuntosAtencion() {
      router.push({
        name: "gestion-vigencias-prestadores-listado-puntos-atencion"
      });
    }
  }
};
</script>
