<template>
    <router-view></router-view>
</template>

<script>
    import user from '../mixins/api/user';
    import {mapMutations} from "vuex";
    import {SER_USER_EMAIL, SET_USER_NAME} from "../store/user/mutations";

    export default {
        mixins: [user],
        created() {
            this.$http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

            console.log('app');
            if (this.$store.state.app.api_key === null) {
                if (this.$route.name !== 'login') {
                    this.$router.push({name: 'login'});
                }
            } else {
                this.$http.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.state.app.api_key;

                this.getUserInfo()
                    .then(response => {
                        this[SET_USER_NAME](response.data.name);
                        this[SER_USER_EMAIL](response.data.email);
                    })
                    .catch(error => {
                        localStorage.removeItem('api_key');
                        this.$router.push({name: 'login'});
                    })
            }
        },
        methods: {
            ...mapMutations('user', [SET_USER_NAME, SER_USER_EMAIL]),
        }
    }
</script>
