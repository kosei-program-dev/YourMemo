import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import NotFound from './views/NotFound.vue'

export default new Router({
    mode: 'history',
    routes: [{
            path: '*',
            component: NotFound
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/',
            name: 'home',
            component: Home
        },

    ]
});
