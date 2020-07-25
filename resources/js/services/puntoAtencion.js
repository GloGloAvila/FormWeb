export default {
  obtenerPuntosAtencion(prestador) {
    return new Promise((resolve, reject) => {
      axios
        .get(`prestadores/${prestador.id}/puntosAtencion`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
