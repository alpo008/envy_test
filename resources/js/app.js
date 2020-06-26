import 'bootstrap/scss/bootstrap.scss'
import 'bootstrap'
import $ from 'jquery'
require('./bootstrap');

import Vue from 'vue';
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './routes'
import VueResource from 'vue-resource'

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

Vue.use(VueRouter)
Vue.use(VueResource)

Vue.http.options.root = '/api/v0'
Vue.http.options.headers = {
    'X-CSRF-TOKEN': csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
}


new Vue({
    router,
    render: h => h(App)
}).$mount('#app')
