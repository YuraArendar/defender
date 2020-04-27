import {SET_API_KEY} from "../../store/app/mutations";

export default {
    methods: {
        login(username, password) {
            return new Promise((resolve, reject) => {
                this.$http.post('/login', {username, password})
                    .then(response => {
                        this.$store.commit('app/' + SET_API_KEY, response.data.access_token);
                        this.$http.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token;
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        },
        logout() {
            return new Promise((resolve, reject) => {
                this.$http.post('/api/logout')
                    .then(response => {
                        this.$store.commit('app/' + SET_API_KEY, null);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    })
            })
        }
    }
}
