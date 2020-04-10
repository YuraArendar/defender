import Vue from 'vue';
import VueRouter from "vue-router";
import Vuex from 'vuex';

import App  from './components/App';

Vue.use(VueRouter);
Vue.use(Vuex);

import {routes} from './routes';
import storage from './store';

const router = new VueRouter({
    routes
});

const store = new Vuex.Store(storage);

const app = new Vue({
    router,
    store,
    el: '#app',
    components: {
        App
    }
});

