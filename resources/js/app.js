/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('Alumno',require('./components/Alumno.vue').default);
Vue.component('Nivel',require('./components/Nivel.vue').default);
Vue.component('Responsable',require('./components/Responsable.vue').default);
Vue.component('Donacion',require('./components/Donaciones.vue').default);
Vue.component('Gasto',require('./components/Gasto.vue').default);
Vue.component('Nuevo',require('./components/Nuevo.vue').default);
Vue.component('Datos',require('./components/Datos.vue').default);
Vue.component('Diagnostico',require('./components/Diagnostico.vue').default);
Vue.component('Reportes',require('./components/Reportes.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import swal from 'sweetalert2';
import alertify from 'alertifyjs';


window.swal = swal;
window.alertify = alertify;


window.Fire = new Vue();
const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});
