import 'bootstrap/scss/bootstrap.scss'
import 'bootstrap'
import $ from 'jquery'
require('./bootstrap');

import Vue from 'vue';
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './routes'

Vue.use(VueRouter)

new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
