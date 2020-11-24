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
  },
  crearFuncionario(prestador, funcionario) {
    return new Promise((resolve, reject) => {
      axios
        .post(`prestadores/${prestador.id}/funcionarios`, funcionario)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  },
  editarFuncionario(prestador, funcionario) {
    return new Promise((resolve, reject) => {
      axios
        .put(`prestadores/${prestador.id}/funcionarios/${funcionario.id}`, funcionario)
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }
}
