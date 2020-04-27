<template>
    <div class="form-group">
        <div class="field">
            <label class="label">Name</label>
            <div class="control is-fullwidth">
                <input class="input" type="text" v-model="form.name">
            </div>
            <p class="help is-danger">This is a help text</p>
        </div>

        <div class="columns">
            <div class="column">
                <a-select v-model="form.controller" :error="errors.errorName" :name="'Controller'"
                          :options="controller_options"></a-select>
            </div>

            <div class="column">
                <a-select v-model="form.template" :name="'Template'" :options="template_options"></a-select>
            </div>
        </div>

        <a-editor></a-editor>

        <div class="field form-buttons">
            <button class="button is-primary is-pulled-right" @click="save">Save</button>
        </div>
    </div>
</template>

<script>
    import ASelect from '../elements/inputs/a-select'
    import AEditor from '../elements/inputs/a-editor'

    const CONTROLLER_OPTIONS = [
        {name: 'Page', value: 'page'},
        {name: 'List', value: 'list'},
        {name: 'Gallery', value: 'gallery'}
    ];
    const TEMPLATE_OPTIONS = [{name: 'Default', value: 'default'}];

    export default {
        name: "edit-form",
        data() {
            return {
                form: {
                    id: null,
                    controller: CONTROLLER_OPTIONS[0].value,
                    template: TEMPLATE_OPTIONS[0].value,
                    alias: null,
                    name: null,
                    content: null,
                    parent_id: null,
                },
                errors: {
                    errorName: '',
                },
                controller_options: CONTROLLER_OPTIONS,
                template_options: TEMPLATE_OPTIONS
            }
        },
        created() {
            this.init()
        },
        props: {
            values: {
                required: false,
                type: Object
            }
        },
        methods: {
            save() {
                this.$emit('save', this.form)
            },
            init() {
                for (let name in this.values) {
                    if (this.form[name] !== undefined) {
                        this.form[name] = this.values[name];
                    }
                }
            }
        },
        components: {
            ASelect,
            AEditor
        }
    }
</script>

<style scoped>

</style>
