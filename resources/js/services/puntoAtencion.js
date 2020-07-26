export default {
  obtenerPuntosAtencion(vigencia, periodo, prestador) {
    return new Promise((resolve, reject) => {
      axios
        .get(`vigencias/${vigencia.id}/periodos/${periodo.id}/prestadores/${prestador.id}/puntosAtencion`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
