import '@/bootstrap';
import '~bootstrap/js/bootstrap.bundle.min.js';
import scripts from '@/scripts';

import { createApp } from 'vue';
import VueSelect from 'vue-select';
import Grid from './components/Grid.vue';
import moment from 'moment';
import 'jquery';

const app = createApp();

app.component('grid', Grid);
app.component('v-select', VueSelect);

app.mount('#app');

scripts(app, moment);


// //FILTROS UTILIZADOS NA VUE
// app.config.globalProperties.$filters = {
//     formatDate(value) {
//         if (value) {
//             return moment(value, 'YYYY-MM-DD').format('DD/MM/YYYY');
//         } else {
//             return 'Data Inválida';
//         }
//     }
// }