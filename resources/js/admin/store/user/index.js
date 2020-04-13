import {SER_USER_EMAIL, SET_USER_NAME} from "./mutations";

export default {
    namespaced: true,
    state: {
        username: null,
        email: null
    },
    mutations: {
        [SET_USER_NAME](state, username) {
            state.username = username
        },
        [SER_USER_EMAIL](state, email) {
            state.email = email
        }
    },
}
