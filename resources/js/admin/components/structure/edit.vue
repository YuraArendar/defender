<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Edit "{{name}}"
            </div>

            <edit-form v-if="form !== null" :values="form" @save="save"></edit-form>
        </div>
    </div>
</template>

<script>
    import EditForm from './edit-form';
    import structure from "../../mixins/api/structure";

    export default {
        data() {
            return {
                name: null,
                form: null,
                id: 0
            }
        },
        mixins: [structure],
        name: "edit",
        components: {
            EditForm
        },
        beforeRouteUpdate(to, from, next) {
            this.loadData(to.params.id);
            next();
        },
        created() {
            this.id = this.$route.params.id;
            this.loadData(this.id);
        },
        methods: {
            loadData(id) {
                this.form = null;
                this.getStructure(id)
                .then(response => {
                    this.name = response.data.name;
                    this.form = response.data;
                })
            },
            save(form) {
                console.log(form);
                this.updateStructure(this.id, form)
                 .then(response => {
                     console.log(response)
                 })
                .catch(error => {
                    console.log(error);
                    console.log(error.response.data);
                })
            }
        }
    }
</script>

<style scoped>

</style>
