export default {
  obtenerPrestadores() {
    return new Promise((resolve, reject) => {
      axios
        .get('prestadores')
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
