import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vuex from 'vuex';
import VueI18n from 'vue-i18n';
import VueCookie from 'vue-cookies';
import VueToasted from 'vue-toasted';

import { library } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import App  from './components/App';

library.add(fas);

Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false;

Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);
Vue.use(VueI18n);
Vue.use(VueCookie);
Vue.use(VueToasted, {
    iconPack : 'fontawesome' // set your iconPack, defaults to material. material|fontawesome|custom-class
});

import {routes} from './routes';
import storage from './store';
import {messages} from "./lang";

const i18n = new VueI18n({
    locale: 'en',
    messages
});

Vue.$cookies.config('7d');

const router = new VueRouter({
    routes
});

const store = new Vuex.Store(storage);

new Vue({
    router,
    store,
    i18n,
    el: '#app',
    components: {
        App
    },
    template: `<App/>`
});

