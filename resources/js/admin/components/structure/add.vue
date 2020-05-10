<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Add new item <locale-changer class="is-pulled-right" :locale="$store.state.app.content_language" @change="changeContentLocale"/>
            </div>

            <edit-form></edit-form>
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
