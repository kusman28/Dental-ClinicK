/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'

import { OverlayScrollbarsPlugin } from 'overlayscrollbars-vue';

Vue.use(OverlayScrollbarsPlugin);

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Routes
import VueRouter from 'vue-router'
Vue.use(VueRouter)
let routes = [
  { path: '/dashboard', component: require('./components/Dashboard').default },
  { path: '/patients', component: require('./components/Patients').default },
  { path: '/brace', component: require('./components/Brace').default },
  { path: '/denture', component: require('./components/Denture').default },
  { path: '/extraction', component: require('./components/Extraction').default },
  { path: '/prescription', component: require('./components/Prescription').default },
  { path: '/payment', component: require('./components/Payment').default },
  { path: '/report', component: require('./components/Report').default },
  { path: '/users', component: require('./components/Users').default },
  { path: '/profile', component: require('./components/Profile').default},
  { path: '*', component: require('./components/NotFound').default}
]
const router = new VueRouter({
	mode: 'history',
  	routes // short for `routes: routes`
})
// End of Routes

// Sweetalert
import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})
window.toast = toast;



// Progressbar
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

// Load Data
window.Fire = new Vue();

// Text filter
Vue.filter('upCase', function(text){
	// return text.toUpperCase();
  return text.charAt(0).toUpperCase() + text.slice(1)
});
Vue.filter('myDate', function(created){
  return moment(created).format('MMMM Do YYYY');
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,

});

// jQuery.noConflict();
// jQuery(document).ready(function($) {
//   $('.ucfirst').keyup(function(event) {
//     var textBox = event.target;
//     var start = textBox.selectionStart;
//     var end = textBox.selectionEnd;
//     textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1).toLowerCase();
//     textBox.setSelectionRange(start, end);
//   });
// });
