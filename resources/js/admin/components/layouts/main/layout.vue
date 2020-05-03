<template>
    <div>
        <nav class="navbar is-four-fifths has-background-white-ter" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="https://bulma.io">
                        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
                    </a>

                    <a role="button" class="navbar-burger burger" id="burger" aria-label="menu" aria-expanded="false"
                       data-target="navbar">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>

                <div id="navbar" class="navbar-menu">
                    <div class="navbar-start">
                        <router-link class="navbar-item" :to="{name: 'dashboard'}">Dashboard</router-link>
                        <router-link class="navbar-item" :to="{name: 'index_structure'}">Structure</router-link>
                    </div>

                    <div class="navbar-end">
                        <LocalChanger/>
                        <div class="navbar-item is-hoverable has-dropdown">
                            <a class="navbar-link">
                                <font-awesome-icon icon="user"/>&nbsp;&nbsp;{{$store.state.user.username}}
                            </a>
                            <div class="navbar-dropdown is-right">
                                <a class="navbar-item">
                                    Overview
                                </a>
                                <hr class="navbar-divider">
                                <div class="navbar-item">
                                    <router-link class="is-link" :to="{name: 'logout'}">{{$t('logout')}}&nbsp;&nbsp;&nbsp;<font-awesome-icon icon="sign-out-alt"/></router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="bd-main">
            <div class="container">
                <breadcrumbs/>
                <router-view></router-view>
            </div>
        </main>

    </div>
</template>

<script>
    import breadcrumbs from '../../elements/bradcrumbs/breadcrumbs';
    import LocalChanger from '../../elements/lang/locale-changer';

    export default {
        mounted() {
            this.initBurger();
        },
        methods: {
            initBurger() {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                if ($navbarBurgers.length > 0) {
                    $navbarBurgers.forEach(el => {
                        el.addEventListener('click', () => {
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);

                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');
                        });
                    });
                }
            }
        },
        components: {
            breadcrumbs,
            LocalChanger,
        }
    }
</script>

<style scoped>

</style>
