<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Edit "{{name}}" <locale-changer class="is-pulled-right" :locale="$store.state.app.content_language" @change="changeContentLocale"/>
            </div>

            <edit-form :values="form" @save="save" :errors="errors"></edit-form>
        </div>
    </div>
</template>

<script>
    import EditForm from './edit-form';
    import structure from "../../mixins/api/structure";
    import LocaleChanger from '../elements/lang/locale-changer';
    import {SET_CONTENT_LANGUAGE} from "../../store/app/mutations";
    import {mapMutations} from "vuex";
    import site_structure from "../../mixins/app/site_structure";

    export default {
        data() {
            return {
                name: null,
                form: null,
                id: 0,
                errors: {}
            }
        },
        mixins: [structure, site_structure],
        name: "edit",
        components: {
            EditForm,
            LocaleChanger
        },
        beforeRouteUpdate(to, from, next) {
            this.loadData(to.params.id);
            this.id = parseInt(to.params.id);
            next();
        },
        created() {
            this.id = this.$route.params.id;
            this.loadData(this.id);
        },
        methods: {
            ...mapMutations('app', [SET_CONTENT_LANGUAGE]),
            loadData(id) {
                this.form = null;
                this.getStructure(id)
                    .then(response => {
                        this.name = response.data.name;
                        this.form = response.data;
                    })
            },
            save(form) {
                this.updateStructure(this.id, form)
                    .then(response => {
                        this.name = response.data.name;

                        this.getStructureTree()
                            .then(tree => {
                                this.setSiteStructure(tree.data);
                            });
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            },
            changeContentLocale(lang) {
                this.$cookies.set('content_language', lang);
                this[SET_CONTENT_LANGUAGE](lang);
                this.getStructureTree()
                    .then(tree => {
                        this.setSiteStructure(tree.data);
                        this.loadData(this.id)
                    });
            }
        }
    }
</script>

<style scoped>

</style>
