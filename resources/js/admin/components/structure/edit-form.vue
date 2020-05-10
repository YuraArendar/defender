<template>
    <div class="form-group">
        <a-switch :name="'Active'" v-model="form.active"/>

        <a-input v-model="form.name" :name="'Name'" :error="inputErrors.name"
                 @onfocus="inputErrors.name = ''"></a-input>
        <a-input v-model="form.alias" :name="'Alias'" :error="inputErrors.alias"
                 @onfocus="inputErrors.alias = ''"></a-input>

        <div class="columns">
            <div class="column">
                <a-tree-select :tree="structure" :name="'Parent id'" :error="inputErrors.parent_id"
                               @onfocus="inputErrors.parent_id = ''" v-model="form.parent_id"></a-tree-select>
            </div>

            <div class="column">
                <a-select v-model="form.controller" :name="'Controller'" :options="controller_options"
                          :error="inputErrors.controller" @onfocus="inputErrors.controller = ''"></a-select>
            </div>

            <div class="column">
                <a-select v-model="form.template" :name="'Template'" :options="template_options"
                          :error="inputErrors.template" @onfocus="inputErrors.template = ''"></a-select>
            </div>
        </div>

        <a-textarea v-model="form.content" name="Content" :error="inputErrors.content"
                    @onfocus="inputErrors.content = ''"></a-textarea>

        <div class="field form-buttons">
            <button class="button is-primary is-pulled-right" @click="save">Save</button>
        </div>
    </div>
</template>

<script>
    import ASelect from '../elements/inputs/a-select'
    import AEditor from '../elements/inputs/a-editor'
    import AInput from '../elements/inputs/a-input';
    import ATextarea from '../elements/inputs/a-textarea';
    import ATreeSelect from '../elements/inputs/a-tree-select';
    import ASwitch from '../elements/inputs/a-switch';

    import site_structure from "../../mixins/app/site_structure";
    import structure from "../../mixins/api/structure";
    import common from "../../mixins/app/common";
    import {SUCCESS_TOAST} from "../../options/toast";

    const CONTROLLER_OPTIONS = [
        {name: 'Page', value: 'page'},
        {name: 'List', value: 'list'},
        {name: 'Gallery', value: 'gallery'}
    ];
    const TEMPLATE_OPTIONS = [{name: 'Default', value: 'default'}];

    export default {
        mixins: [site_structure, common, structure],
        name: "edit-form",
        data() {
            return {
                form: {
                    locale: this.$store.state.app.content_language,
                    id: null,
                    active: true,
                    controller: CONTROLLER_OPTIONS[0].value,
                    template: TEMPLATE_OPTIONS[0].value,
                    alias: null,
                    name: null,
                    content: null,
                    parent_id: null,
                },
                inputErrors: {
                    controller: null,
                    template: null,
                    alias: null,
                    name: null,
                    content: null,
                    parent_id: null,
                },
                id: null,
                controller_options: CONTROLLER_OPTIONS,
                template_options: TEMPLATE_OPTIONS
            }
        },
        beforeRouteUpdate(to, from, next) {
            this.loadData(to.params.id);

            if (to.params.id) {
                this.id = parseInt(to.params.id);
            }

            next();
        },
        created() {
            this.id = parseInt(this.$route.params.id);

            if (this.id) {
                this.loadData(this.id);
            }
        },
        methods: {
            save() {
                if (this.id) {
                    this.update();
                } else {
                    this.create();
                }
            },
            update() {
                this.updateStructure(this.id, this.form)
                    .then(response => {
                        this.name = response.data.name;

                        this.getStructureTree()
                            .then(tree => {
                                this.setSiteStructure(tree.data);
                                this.$toasted.success('Saved', SUCCESS_TOAST);
                            });
                    })
                    .catch(error => {
                        this.errors(error.response.data.errors);
                    })
            },
            create() {
                this.createNewItem(this.form)
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
                        this.errors(error.response.data.errors);
                    })
            },
            loadData(id) {
                this.getStructure(id)
                    .then(response => {
                        this.values(response.data);
                    })
            },
        },
        computed: {
            language() {
                let language = this.$store.state.app.content_language;
                this.form.locale = language;
                this.loadData(this.id);
                return language;
            }
        },
        components: {
            ASelect,
            AEditor,
            AInput,
            ATextarea,
            ATreeSelect,
            ASwitch,
        }
    }
</script>

<style type="text/css">
    .form-group {
        padding: 15px;
    }

    .form-buttons {
        min-height: 40px;
    }
</style>
