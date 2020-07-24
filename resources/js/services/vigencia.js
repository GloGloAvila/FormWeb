export default {
  obtenerVigencias() {
    return new Promise((resolve, reject) => {
      axios
        .get('vigencias')
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  },
  crearVigencia(vigencia) {
    return new Promise((resolve, reject) => {
      axios
        .post('vigencias', { data: vigencia })
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  },
  actualizarVigencia(vigencia) {
    return new Promise((resolve, reject) => {
      axios
        .put(`vigencias/${vigencia.id}`, { data: vigencia })
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }

}
