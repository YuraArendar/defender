<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Add new item <locale-changer class="is-pulled-right" :locale="$store.state.app.content_language" @change="changeContentLocale"/>
            </div>

            <edit-form :values="form" :errors="errors" @save="save"></edit-form>
        </div>
    </div>
</template>

<script>
    import EditForm from './edit-form';
    import structure from "../../mixins/api/structure";
    import site_structure from "../../mixins/app/site_structure";
    import LocaleChanger from '../elements/lang/locale-changer';
    import {mapMutations} from "vuex";
    import {SET_CONTENT_LANGUAGE} from "../../store/app/mutations";
    import {SUCCESS_TOAST} from "../../options/toast";

    export default {
        mixins: [structure, site_structure],
        name: "add",
        data() {
            return {
                form: null,
                errors: {}
            }
        },
        created() {
            this.setActiveStructure(null);
        },
        components: {
            EditForm,
            LocaleChanger,
        },
        methods: {
            ...mapMutations('app', [SET_CONTENT_LANGUAGE]),
            save(form) {
                this.createNewItem(form)
                    .then(response => {
                        this.getStructureTree()
                            .then(tree => {
                                this.setSiteStructure(tree.data);
                                this.setActiveStructure(response.data.id);
                                this.$toasted.success('Saved', SUCCESS_TOAST);
                            });

                        this.$router.push({name: 'edit_structure', params: {id: response.data.id}})
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
                    });
            }
        }
    }
</script>

<style scoped>

</style>
