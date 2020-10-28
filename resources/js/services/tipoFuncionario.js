export default {
  obtenerTiposFuncionario() {
    return new Promise((resolve, reject) => {
      axios
        .get(`tiposFuncionario`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
