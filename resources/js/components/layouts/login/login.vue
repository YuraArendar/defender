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
                                    <button class="button is-fullwidth is-primary" @click="login">Login</button>
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
    import {LOGIN} from "../../../store/actions";

    export default {
        name: "login",
        data() {
            return {
                credentials: {
                    username: null,
                    password: null
                },
                loginError: false
            }
        },
        methods: {
            login() {
                this.$store.dispatch(LOGIN, this.credentials)
                .then(data => {
                    this.loginError = false;
                    console.log(data)
                })
                .catch(error => {
                    this.loginError = true;
                    console.log(error);
                })
            },
            closeAlert() {
                console.log('fdfsd');
                this.loginError = false;
            }
        }
    }
</script>

<style scoped>

</style>
