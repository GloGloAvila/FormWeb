export default {
  obtenerPuntosAtencion(periodo, prestador) {
    return new Promise((resolve, reject) => {
      axios
        .get(`periodos/${periodo.id}/prestadores/${prestador.id}/puntosAtencion`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
