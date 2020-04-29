<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Add new item
            </div>

            <edit-form :values="form" @save="save"></edit-form>
        </div>
    </div>
</template>

<script>
    import EditForm from './edit-form';
    import structure from "../../mixins/api/structure";
    import site_structure from "../../mixins/app/site_structure";

    export default {
        mixins: [structure, site_structure],
        name: "add",
        data() {
            return {
                form: null
            }
        },
        components: {
            EditForm
        },
        methods: {
            save(form) {
                this.createNewItem(form)
                    .then(response => {
                        this.getStructureTree()
                            .then(tree => {
                                this.setSiteStructure(tree.data);
                                this.setActiveStructure(response.data.id);
                            });

                        this.$router.push({name: 'edit_structure', params: {id: response.data.id}})
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
