<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Edit "{{name}}" <locale-changer class="is-pulled-right" :locale="$store.state.app.content_language" @change="changeContentLocale"/>
            </div>
            <div class="tabs">
                <ul>
                    <li class="is-active"><router-link class="is-link" :to="{name: 'edit_structure'}">{{$t('edit')}}<font-awesome-icon icon="sign-out-alt"/></router-link></li>
                    <li><a><router-link class="is-link" :to="{name: 'edit_structure'}">{{$t('meta')}}<font-awesome-icon icon="sign-out-alt"/></router-link></a></li>
                    <li><a><router-link class="is-link" :to="{name: 'edit_structure'}">{{$t('content')}}<font-awesome-icon icon="sign-out-alt"/></router-link></a></li>
                </ul>
            </div>

            <router-view></router-view>

        </div>
    </div>
</template>

<script>
    import LocaleChanger from '../elements/lang/locale-changer';
    import {SET_CONTENT_LANGUAGE} from "../../store/app/mutations";
    import {mapMutations} from "vuex";
    import site_structure from "../../mixins/app/site_structure";

    export default {
        mixins: [site_structure],
        name: "edit",
        components: {
            LocaleChanger
        },
        methods: {
            ...mapMutations('app', [SET_CONTENT_LANGUAGE]),
            changeContentLocale(lang) {
                this.$cookies.set('content_language', lang);
                this[SET_CONTENT_LANGUAGE](lang);
            }
        },
        computed: {
            name() {
                let active = this.$store.state.app.active_structure;
                let structure = this.$store.state.app.site_structure;

                if (active && structure) {
                    let current = this.findStructureById(structure, active);

                    if (current) {
                        return current.name || current.id;
                    }
                }

                return '';
            }
        }
    }
</script>

<style scoped>

</style>
