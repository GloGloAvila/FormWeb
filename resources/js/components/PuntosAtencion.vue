<template>
  <div>
    <v-app id="inspire">
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
              <v-data-table :headers="headers" :items="puntosAtencion" class="elevation-1">
                <template v-slot:header.id="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.prestador="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.departamento="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.municipio="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.puntoAtencion="{ header }">{{ header.text.toUpperCase() }}</template>
                <template v-slot:header.accion="{ header }">{{ header.text.toUpperCase() }}</template>

                <template v-slot:item.accion="{ item }">
                  <v-icon
                    medium
                    class="mr-2 text-center"
                    color="red accent-4"
                    @click="editItem(item)"
                  >mdi-pencil</v-icon>
                </template>
                <template slot="no-data">No tiene información registrada</template>
              </v-data-table>
            </CCol>
          </CRow>
        </CCardBody>
      </CCard>
    </v-app>
  </div>
</template>

<script>
export default {
  name: "PuntosAtencion",
  components: {},
  mounted() {
    this.cargarListadoPuntosAtencion();
  },
  data() {
    return {
      modalFormulario: false,
      botonGuardar: true,
      headers: [
        {
          text: "Consecutivo",
          value: "id",
          sortable: false
        },
        {
          text: "Prestador",
          value: "prestador",
          sortable: false
        },
        {
          text: "Departamento",
          value: "departamento",
          sortable: false
        },
        {
          text: "Municipio",
          value: "municipio",
          sortable: false
        },
        {
          text: "Punto de Atención",
          value: "puntoAtencion",
          sortable: false
        },
        {
          text: "Estado",
          value: "accion",
          sortable: false
        }
      ],
      puntosAtencion: []
    };
  },
  methods: {
    cargarListadoPuntosAtencion() {
      this.puntosAtencion = [
        {
          id: "001",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 43A No 23-73 LOCAL 142",
          departamento: "05",
          municipio: "05001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "002",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 49C No 80-264 LOCAL 4",
          departamento: "08",
          municipio: "08001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "003",
          prestador: "ADECCO",
          puntoAtencion: "AVENIDA CALLE 13 No 65-78",
          departamento: "11",
          municipio: "11001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "004",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 7 No 55-32",
          departamento: "11",
          municipio: "11001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "005",
          prestador: "ADECCO",
          puntoAtencion: "CALLE 70A No 9-46",
          departamento: "11",
          municipio: "11001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "006",
          prestador: "ADECCO",
          puntoAtencion: "PLAZUELA C.C SHOPPING CENTER II LOCAL 8",
          departamento: "13",
          municipio: "13001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "007",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 23 No 59-26 LOCAL 3",
          departamento: "17",
          municipio: "17001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "008",
          prestador: "ADECCO",
          puntoAtencion:
            "CARRERA 7N No 6A - 09 LOC 115, CC.PLAZA DEL FERROCARRIL",
          departamento: "19",
          municipio: "19001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "009",
          prestador: "ADECCO",
          puntoAtencion:
            "CARRERA 48 No 7-01 LOCAL 9,  CENTRO COMERCIAL LA HACIENDA",
          departamento: "50",
          municipio: "50001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "010",
          prestador: "ADECCO",
          puntoAtencion: "AVENIDA 30 DE AGOSTO No 42-01",
          departamento: "66",
          municipio: "66001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "011",
          prestador: "ADECCO",
          puntoAtencion: "CALLE 73 No 27-42  LOCAL  4",
          departamento: "68",
          municipio: "68081",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "012",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 27 No 36-38 LOCAL 125",
          departamento: "68",
          municipio: "68081",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "013",
          prestador: "ADECCO",
          puntoAtencion:
            "CARRERA 5 No 29-32 LOCAL 250 PISO 2, CENTRO COMERCIAL LA QUINTA",
          departamento: "73",
          municipio: "73001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "014",
          prestador: "ADECCO",
          puntoAtencion: "CALLE 44 NORTE No 2FN-28 la merced",
          departamento: "76",
          municipio: "76001",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "015",
          prestador: "ADECCO",
          puntoAtencion: "CARRERA 28 No 30-19 LOCAL 201",
          departamento: "76",
          municipio: "76520",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        },
        {
          id: "016",
          prestador: "ADECCO",
          puntoAtencion: "www.adeccoempleo.com",
          departamento: "00",
          municipio: "00000",
          correo: "candidatos.adecco@adecco.com",
          paginaWeb: "http://www.adecco.com.co",
          fechaRegistro: "2019-10-11"
        }
      ];
    },
    abrirFormulario() {
      console.log(this.modalFormulario);
      this.modalFormulario = true;
    },
    getColor(calories) {
      if (calories > 400) return "red";
      else if (calories > 200) return "orange";
      else return "green";
    }
  }
};
</script>
