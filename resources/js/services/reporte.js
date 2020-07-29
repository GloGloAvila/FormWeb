export default {
  guardarReporte(puntoAtencion, periodo, reporte) {
    return new Promise((resolve, reject) => {
      axios
        .post(`puntosAtencion/${puntoAtencion.id}/periodos/${periodo.id}/reportes`, { data: reporte })
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
