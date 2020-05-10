<template>
    <div class="form-group">
        <a-input v-model="form.title" :name="'Title'" :error="inputErrors.title"
                 @onfocus="inputErrors.title = ''"></a-input>
        <a-textarea v-model="form.description" :name="'Description'" :error="inputErrors.description"
                    @onfocus="inputErrors.description = ''"></a-textarea>

        <div class="columns">
            <div class="column">
                <a-switch @change="indexChange" :name="'index'" v-model="form.index"/>
            </div>

            <div class="column">
                <a-switch @change="noindexChange" :name="'noindex'" v-model="form.noindex"/>
            </div>

            <div class="column">
                <a-switch @change="followChange" :name="'follow'" v-model="form.follow"/>
            </div>

            <div class="column">
                <a-switch @change="nofollowChange" :name="'nofollow'" v-model="form.nofollow"/>
            </div>
        </div>

        <div class="field form-buttons">
            <button class="button is-primary is-pulled-right" @click="save">Save</button>
        </div>
    </div>
</template>

<script>
    import AInput from '../elements/inputs/a-input';
    import ATextarea from '../elements/inputs/a-textarea';
    import ASwitch from '../elements/inputs/a-switch';

    import structure_meta from "../../mixins/api/structure_meta";
    import common from "../../mixins/app/common";
    import {SUCCESS_TOAST} from "../../options/toast";

    export default {
        mixins: [structure_meta, common],
        data() {
            return {
                id: null,
                form: {
                    locale: this.$store.state.app.content_language,
                    follow: false,
                    nofollow: false,
                    index: false,
                    noindex: false,
                    title: null,
                    description: null,
                    structure_id: null
                },
                inputErrors: {
                    title: null,
                    description: null,
                }
            }
        },
        created() {
            if (this.$route.params.id) {
                this.form.structure_id = parseInt(this.$route.params.id);
                this.loadData(this.$route.params.id);
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
            loadData(id) {
                this.getMeta(id)
                    .then(response => {
                        console.log(response);
                        if (response.data.id) {
                            this.id = response.data.id;
                        }

                        this.values(response.data);
                    })
            },
            create() {
                this.createMeta(this.form)
                    .then(response => {
                        this.$toasted.success('Saved', SUCCESS_TOAST);
                    })
                    .catch(error => {
                        this.errors(error.response.data.errors);
                    })
            },
            update() {
                this.updateMeta(this.id, this.form)
                    .then(response => {
                        this.$toasted.success('Saved', SUCCESS_TOAST);
                    })
                    .catch(error => {
                        this.errors(error.response.data.errors);
                    })
            },
            indexChange() {
                if (this.form.noindex) {
                    this.form.noindex = false;
                }
            },
            noindexChange() {
                if (this.form.index) {
                    this.form.index = false;
                }
            },
            followChange() {
                if (this.form.nofollow) {
                    this.form.nofollow = false;
                }
            },
            nofollowChange() {
                if (this.form.follow) {
                    this.form.follow = false;
                }
            }
        },
        components: {
            ASwitch,
            ATextarea,
            AInput
        }
    }
</script>

<style scoped>

</style>
