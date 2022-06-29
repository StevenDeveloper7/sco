import router from './routes';
import VueRouter from 'vue-router'

import Vue from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import moment from 'moment'

import VCalendar from 'v-calendar';

import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect)

//Daterange
Vue.use(VCalendar, {componentPrefix: 'vc'});


// Moment
Vue.prototype.moment = moment

require('./bootstrap');

window.Vue = require('vue');

// Millares
Vue.filter('format-thousands', function (value) {
    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('principal', require('./components/layouts/Principal.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);

Vue.component('dashboard', require('./views/Dashboard.vue').default);
Vue.component('clientes', require('./views/Clientes.vue').default);
Vue.component('laboratorios', require('./views/Laboratorios.vue').default);
Vue.component('ventas', require('./views/Ventas.vue').default);
Vue.component('usuarios', require('./views/Usuarios.vue').default);
Vue.component('reportes', require('./views/Reportes.vue').default);
Vue.component('comisiones', require('./views/Comisiones.vue').default);
Vue.component('configuracion', require('./views/Configuracion.vue').default);
Vue.component('categoria_productos', require('./views/Categoria_productos.vue').default);

//sweet alert
Vue.use(VueSweetalert2);

// Set Vue router
Vue.router = router
Vue.use(VueRouter)


const app = new Vue({
    el: '#app',
    router
});
