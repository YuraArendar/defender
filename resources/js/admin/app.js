import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vuex from 'vuex';

import ClickOutside from 'vue-click-outside'

import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import App  from './components/App';

library.add(fas);

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);

Vue.directive('outside', ClickOutside);

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

