import axios from 'axios';

import {
    SET_ACTIVE_STRUCTURE,
    SET_API_KEY,
    SET_CONTENT_LANGUAGE,
    SET_SITE_STRUCTURE
} from "./mutations";
import {LOGIN} from "./actions";
import {GET_ACTIVE_STRUCTURE, GET_STRUCTURE} from "./getters";

export default {
    namespaced: true,
    state: {
        api_key: localStorage.getItem('api_key') || null,
        active_structure: null,
        site_structure: null,
        content_language: 'en',
    },
    mutations: {
        [SET_API_KEY](state, key) {
            localStorage.setItem('api_key', key);
            state.api_key = key;
        },
        [SET_ACTIVE_STRUCTURE](state, id) {
            state.active_structure = id;
        },
        [SET_SITE_STRUCTURE](state, tree) {
            state.site_structure = tree;
        },
        [SET_CONTENT_LANGUAGE](state, locale) {
            state.content_language = locale;
        }
    },
    actions: {
        [LOGIN](context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/login', {
                    username: credentials.username,
                    password: credentials.password
                })
                    .then(response => {
                        context.commit(SET_API_KEY, response.data.access_token);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        }
    },
    getters: {
        [GET_ACTIVE_STRUCTURE]: state => {
            return state.active_structure;
        },
        [GET_STRUCTURE]: state => {
            return state.site_structure;
        },
    }
}
