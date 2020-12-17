export default {
    obtenerReporteMensual(periodo) {
        return `/vigencias/periodos/${periodo.id}/reporte/mensual`;
    },
    obtenerReporte(puntoAtencion, periodo) {
        return new Promise((resolve, reject) => {
            axios
                .get(
                    `puntosAtencion/${puntoAtencion.id}/periodos/${periodo.id}/reportes`
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
    guardarReporte(puntoAtencion, periodo, reporte) {
        return new Promise((resolve, reject) => {
            axios
                .post(
                    `puntosAtencion/${puntoAtencion.id}/periodos/${periodo.id}/reportes`,
                    { data: reporte }
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
    actualizarReporte(puntoAtencion, periodo, reporte) {
        return new Promise((resolve, reject) => {
            axios
                .put(
                    `puntosAtencion/${puntoAtencion.id}/periodos/${periodo.id}/reportes/${reporte.id}`,
                    { data: reporte }
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
