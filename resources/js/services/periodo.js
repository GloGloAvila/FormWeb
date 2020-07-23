export default {
  actualizarPeriodo(vigencia, periodo) {
    return new Promise((resolve, reject) => {
      axios
        .put(`vigencias/${vigencia.id}/periodos/${periodo.id}`, { data: periodo })
        .then(response => {
          resolve(response.data)
        }, response => {
          reject(response.data)
        })
    })
  }

}
