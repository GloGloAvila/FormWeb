export default {
  obtenerPrestadores(periodo) {
    return new Promise((resolve, reject) => {
      axios
        .get(`periodos/${periodo.id}/prestadores`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
