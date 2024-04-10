export default function teste(app, moment) {
    console.log('inside scripts.js');

    //FILTROS UTILIZADOS NA VUE
    app.config.globalProperties.$filters = {
        formatDate(value) {
            if (value) {
                return moment(value, 'YYYY-MM-DD').format('DD/MM/YYYY');
            } else {
                return 'Data Inválida';
            }
        }
    }


}

