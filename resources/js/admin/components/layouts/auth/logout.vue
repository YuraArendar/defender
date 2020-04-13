<template>

</template>

<script>
    import auth from '../../../mixins/api/auth';
    import {mapMutations} from "vuex";
    import {SER_USER_EMAIL, SET_USER_NAME} from "../../../store/user/mutations";
    import {SET_API_KEY} from "../../../store/app/mutations";

    export default {
        mixins: [auth],
        created() {
            console.log('logout');
            this.logout()
                .then(response => {
                    this.clearUserInfo();
                })
            .catch(error => {
                this.clearUserInfo();
            });
        },
        methods: {
            ...mapMutations('user', [SET_USER_NAME, SER_USER_EMAIL]),
            ...mapMutations('app', [SET_API_KEY]),
            clearUserInfo() {
                localStorage.removeItem('api_key');
                this[SER_USER_EMAIL](null);
                this[SET_USER_NAME](null);
                this[SET_API_KEY](null);
                this.$router.push({name: 'login'});
            }
        }
    }
</script>

<style scoped>

</style>
