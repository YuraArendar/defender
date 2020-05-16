<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Edit "{{name}}"
                <locale-changer class="is-pulled-right" :locale="$store.state.app.content_language"
                                @change="changeContentLocale"/>
            </div>
            <div class="tabs">
                <ul>
                    <li :class="{'is-active': $route.name === 'edit_structure'}">
                        <router-link class="is-link" :to="{name: 'edit_structure', params: {id: $route.params.id}}">
                            <font-awesome-icon icon="edit"/>&nbsp;&nbsp;{{$t('edit')}}
                        </router-link>
                    </li>
                    <li :class="{'is-active': $route.name === 'meta_structure'}"><a>
                        <router-link class="is-link" :to="{name: 'meta_structure', params: {id: $route.params.id}}">
                            <font-awesome-icon icon="globe"/>&nbsp;&nbsp;{{$t('meta')}}
                        </router-link>
                    </a></li>
                    <li v-if="showContentLink" :class="{'is-active': ['content_structure', 'add_content'].includes($route.name)}"><a>
                        <router-link class="is-link" :to="{name: 'content_structure', params: {id: $route.params.id}}">
                            <font-awesome-icon icon="book"/>&nbsp;&nbsp;{{$t('content')}}
                        </router-link>
                    </a></li>
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
        data() {
            return {
                currentStructure: null
            }
        },
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
                        this.currentStructure = current;
                        return current.name || current.id;
                    } else {
                        this.currentStructure = null;
                    }
                }

                return '';
            },
            showContentLink() {
                return this.currentStructure !== null && ['gallery', 'list'].includes(this.currentStructure.controller)
            }
        }
    }
</script>

<style scoped>

</style>
