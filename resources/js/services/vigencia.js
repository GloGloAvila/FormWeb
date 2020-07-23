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
  }

}
