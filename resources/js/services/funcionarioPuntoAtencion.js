export default {
    asociarPuntoAtencion(funcionario, puntoAtencion) {
        return new Promise((resolve, reject) => {
            axios
                .post(
                    `funcionarios/${funcionario.id}/puntosAtencion`, puntoAtencion
                )
                .then(
                    response => {
                        resolve(response.data);
                    },
                    response => {
                        reject(response.data);
                    }
                );
        });
    },
    desasociarPuntoAtencion(funcionario, puntoAtencion) {
        return new Promise((resolve, reject) => {
            axios
                .delete(
                    `funcionarios/${funcionario.id}/puntosAtencion/${puntoAtencion.id}`
                )
                .then(
                    response => {
                        resolve(response.data);
                    },
                    response => {
                        reject(response.data);
                    }
                );
        });
    }
};
