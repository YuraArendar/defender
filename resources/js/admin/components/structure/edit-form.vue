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

    const CONTROLLER_OPTIONS = [
        {name: 'Page', value: 'page'},
        {name: 'List', value: 'list'},
        {name: 'Gallery', value: 'gallery'}
    ];
    const TEMPLATE_OPTIONS = [{name: 'Default', value: 'default'}];

    export default {
        mixins: [site_structure],
        name: "edit-form",
        data() {
            return {
                form: {
                    locale: 'en',
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
                controller_options: CONTROLLER_OPTIONS,
                template_options: TEMPLATE_OPTIONS
            }
        },
        props: {
            values: {
                required: false,
                type: Object
            },
            errors: {
                required: false,
                type: Object
            }
        },
        methods: {
            save() {
                this.$emit('save', this.form)
            },
        },
        watch: {
            errors(errorsList) {
                for (let name in errorsList) {
                    if (this.inputErrors[name] !== undefined) {
                        this.$set(this.inputErrors, name, errorsList[name][0]);
                    }
                }
            },
            values(form) {
                for (let name in form) {
                    if (this.form[name] !== undefined) {
                        this.$set(this.form, name, form[name])
                    }
                }
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
