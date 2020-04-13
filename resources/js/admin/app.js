import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vuex from 'vuex';

import App  from './components/App';

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);

import {routes} from './routes';
import storage from './store';

const router = new VueRouter({
    routes
});

const store = new Vuex.Store(storage);

new Vue({
    router,
    store,
    el: '#app',
    components: {
        App
    },
    template: `<App/>`
});

