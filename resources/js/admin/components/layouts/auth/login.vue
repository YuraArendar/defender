<template>
    <div>
        <section class="section">
            <div class="columns is-centered">
                <div class="column is-one-third">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Please, login
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control">
                                    <input class="input" type="text" v-model="credentials.username">
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Password</label>
                                <div class="control">
                                    <input class="input" type="password" v-model="credentials.password">
                                </div>
                            </div>

                            <div class="notification is-danger" v-if="loginError">
                                <button class="delete" @click="closeAlert"></button>
                                Check your credentials
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button class="button is-fullwidth is-primary" @click="authorization">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import auth from '../../../mixins/api/auth';
    import user from '../../../mixins/api/user';
    import {SER_USER_EMAIL, SET_USER_NAME} from "../../../store/user/mutations";
    import {mapMutations} from "vuex";

    export default {
        mixins: [auth, user],
        data() {
            return {
                credentials: {
                    username: null,
                    password: null
                },
                loginError: false
            }
        },
        created() {
            if (this.$store.state.app.api_key !== null) {
                this.$router.push({name: 'main'});
            }
        },
        methods: {
            ...mapMutations('user', [SER_USER_EMAIL, SET_USER_NAME]),
            authorization() {
                this.login(this.credentials.username, this.credentials.password)
                .then(data => {
                    this.loginError = false;
                    this.getUserInfo()
                        .then(response => {
                            this[SET_USER_NAME](response.data.name);
                            this[SER_USER_EMAIL](response.data.email);
                            this.$router.push({name: 'main'});
                        });
                })
                .catch(error => {
                    this.loginError = true;
                })
            },
            closeAlert() {
                this.loginError = false;
            }
        }
    }
</script>

<style scoped>

</style>
