import VueRouter from 'vue-router'

import Home from './components/Home.vue'
import Contact from './components/Contact.vue'
import Info from './components/Info.vue'

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact
        },
        {
            path: '/info',
            name: 'info',
            component: Info
        }
    ],
    mode: "history"
});
