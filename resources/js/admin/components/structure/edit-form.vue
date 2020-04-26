<template>
    <div class="panel">
        <div class="panel-heading">
            Site structure
        </div>
        <div class="form-group">
            <div class="field">
                <label class="label">Name</label>
                <div class="control is-fullwidth">
                    <input class="input" type="text" placeholder="Text input">
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

    </div>
</template>

<script>
    import ASelect from '../elements/inputs/a-select'
    import AEditor from '../elements/inputs/a-editor'

    const CONTROLLER_OPTIONS = [{name: 'Page', value: 'page'}, {name: 'List', value: 'list'}, {
        name: 'Gallery',
        value: 'gallery'
    }];
    const TEMPLATE_OPTIONS = [{name: 'Default', value: 'default'}];

    export default {
        name: "edit-form",
        data() {
            return {
                form: {
                    controller: CONTROLLER_OPTIONS[0].value,
                    template: TEMPLATE_OPTIONS[0].value,
                },
                errors: {
                    errorName: '',
                },
                controller_options: CONTROLLER_OPTIONS,
                template_options: TEMPLATE_OPTIONS
            }
        },
        methods: {
            save() {
                this.errors.errorName = 'fsdfds';
                console.log(this.form)
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
