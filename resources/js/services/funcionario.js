export default {
  obtenerFuncionarios(prestador) {
    return new Promise((resolve, reject) => {
      axios
        .get(`prestadores/${prestador.id}/funcionarios`)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
