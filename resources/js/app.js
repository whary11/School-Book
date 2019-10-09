/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import router from './admin/router'
import store from './admin/store'
import VueSweetalert2 from 'vue-sweetalert2';
import {
    Datetime
} from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'

import VueRouter from 'vue-router'
import {
    ClientTable
} from 'vue-tables-2';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Message from 'vue-m-message'
import VueMoment from 'vue-moment'
import moment from 'moment-timezone'
require('moment/locale/es')

//Filtros
import age from './admin/filters/age'
import Vue from 'vue';
// Import component
import Loading from 'vue-loading-overlay';
// Import stylesheet
import 'vue-loading-overlay/dist/vue-loading.css';
// Init plugin

import VueScrollTo from 'vue-scrollto'


//Directivas personalizadas 
//Permmisions

import Permissions from './admin/directives/permissions'

// var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo, {
    container: "body",
    duration: 500,
    easing: "ease",
    offset: 0,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
})

// Register a global custom directive called `v-focus`
// Vue.directive('permmisions', {
//     inserted: function (el, d, vnode) {


//         el.remove()
//     }
// })








require('./bootstrap');

window.Vue = require('vue');




/// Uses

Vue.use(VueRouter)
Vue.use(ClientTable);
Vue.use(Message)
Vue.use(VueSweetalert2, {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
});
Vue.use(VueMoment, {
    moment
});
Vue.use(age)
Vue.use(Permissions)
Vue.use(Loading, {
    color: "red"
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('index', require('./components/Index.vue').default);
Vue.component('v-select', vSelect)
Vue.component('datetime', Datetime);
// Vue.component('mdb-datatable', mdbDatatable);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});
