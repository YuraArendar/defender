<template>
    <div class="has-padding-15">
        <a-switch :name="'Active'" v-model="form.active"/>

        <a-input v-model="form.name" :name="'Name'" :error="inputErrors.name"
                 @onfocus="inputErrors.name = ''"></a-input>
        <a-input v-model="form.alias" :name="'Alias'" :error="inputErrors.alias"
                 @onfocus="inputErrors.alias = ''"></a-input>

        <div class="columns">
            <div class="column">
                <a-tree-select :tree="structure" :name="'Structure'" :error="inputErrors.structure_id"
                               @onfocus="inputErrors.structure_id = ''" v-model="form.structure_id"></a-tree-select>
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
    import ASelect from "../elements/inputs/a-select";
    import AEditor from "../elements/inputs/a-editor";
    import AInput from "../elements/inputs/a-input";
    import ATextarea from "../elements/inputs/a-textarea";
    import ATreeSelect from "../elements/inputs/a-tree-select";
    import ASwitch from "../elements/inputs/a-switch";

    import site_structure from "../../mixins/app/site_structure";
    import content from "../../mixins/api/content";
    import common from "../../mixins/app/common";
    import {SUCCESS_TOAST} from "../../options/toast";

    const TEMPLATE_OPTIONS = [{name: 'Default', value: 'default'}];

    export default {
        mixins: [site_structure, content, common],
        name: "edit-form",
        data() {
            return {
                form: {
                    locale: this.$store.state.app.content_language,
                    id: null,
                    active: true,
                    template: TEMPLATE_OPTIONS[0].value,
                    alias: null,
                    position: 0,
                    name: null,
                    content: null,
                    structure_id: null,
                    publish_at: null,
                    image: null,
                },
                inputErrors: {
                    template: null,
                    alias: null,
                    name: null,
                    content: null,
                    structure_id: null,
                    publish_at: null,
                    image: null,
                },
                id: null,
                template_options: TEMPLATE_OPTIONS
            }
        },
        created() {
            this.init();
        },
        methods: {
            init() {
                let structureId = this.$route.params.id || this.$route.params.structureId;
                let contentId = parseInt(this.$route.params.contentId) || null;
                console.log(structureId, contentId);
                this.form.structure_id = parseInt(structureId);
                this.form.id = contentId;
                this.id = contentId;

                if (this.id) {
                    this.loadData();
                }
            },
            save() {
                if (this.id) {
                    this.update();
                } else {
                    this.create();
                }
            },
            loadData() {
                this.getContentById(this.id)
                    .then(response => {
                        this.values(response.data);
                    })
            },
            update() {
                this.updateContent(this.id, this.form)
                    .then(response => {
                        this.$toasted.success('Saved', SUCCESS_TOAST);
                    })
                    .catch(error => {
                        this.errors(error.response.data.errors);
                    })
            },
            create() {
                this.addNewArticle(this.form)
                    .then(response => {
                        this.values(response.data);
                        this.id = response.data.id;
                        this.$toasted.success('Saved', SUCCESS_TOAST);
                    })
                    .catch(error => {
                        this.errors(error.response.data.errors);
                    })
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

<style scoped>

</style>
