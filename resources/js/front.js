require('./common');

import Vue from 'vue';
import App from './App';
import VueRouter from 'vue-router'; // importazione vue-router
import PageHome from './pages/PageHome';
import PageAbout from './pages/PageAbout';
import PagePost from './pages/PagePost';
import PagePosts from './pages/PagePosts';
import Page404 from './pages/Page404';

Vue.use(VueRouter); // diciamo a vue di usare il plugin vue-router

const routes = [ // creiamo le nostre specifiche rotte
    {
        path: '/',
        name: 'home', //i name servono per creare link dinamici (guarda NavBar.vue)
        component: PageHome,
    },
    {
        path: '/about',
        name: 'about',
        component: PageAbout,
    },
    {
        path: '/posts',
        name: 'postsIndex',
        component: PagePosts,
    },
    {
        path: '/posts/:slug', // TODO: dare il parametro
        name: 'postsShow',
        component: PagePost,
        props: true, // siccome questa rotta ha un parametro usiamo props, senza dovremmo usare $route.params.slug per recuperare i params
    },
    {
        path: '*',
        name: 'page404',
        component: Page404,
    }
];

// personalizzazione del vue-router
const router = new VueRouter({
    mode: 'history', // toglie l'# dagli indirizzi, ma richiede delle modifiche lato server (guarda web.php)
    routes, // routes: routes
});

new Vue({
    el: '#root',
    render: h => h(App), // renderizzare App nella #root
    // usare vue-router specifico al nostro progetto
    router // router: router
});
