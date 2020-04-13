<template>
    <div>
        <nav class="navbar is-four-fifths has-background-white-bis" role="navigation" aria-label="main navigation">
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
                        <router-link class="navbar-item" :to="{name: 'structure'}">Structure</router-link>


                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                More
                            </a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item">
                                    About
                                </a>
                                <a class="navbar-item">
                                    Jobs
                                </a>
                                <a class="navbar-item">
                                    Contact
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item">
                                    Report an issue
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div class="buttons">
                                <router-link class="button is-light" :to="{name: 'logout'}">Logout</router-link>
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

    export default {
        mounted() {
            this.initBurger();
        },
        methods: {
            initBurger() {
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
                console.log($navbarBurgers);
                if ($navbarBurgers.length > 0) {
                    $navbarBurgers.forEach(el => {
                        console.log(el);
                        el.addEventListener('click', () => {
                            const target = el.dataset.target;
                            console.log(target);
                            const $target = document.getElementById(target);

                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');
                        });
                    });
                }
            }
        },
        components: {
            breadcrumbs
        }
    }
</script>

<style scoped>

</style>
