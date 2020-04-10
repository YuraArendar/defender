import axios from 'axios';

import {SET_API_KEY} from "./mutations";
import {LOGIN} from "./actions";

export default {
    state: {
        api_key: localStorage.getItem('api_key')
    },
    mutations: {
        [SET_API_KEY](state, key) {
            localStorage.setItem('api_key', key);
            state.api_key = key;
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
    }
}
