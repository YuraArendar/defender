<template>
    <div>
        <div class="columns">
            <div v-if="structure !== null" class="column is-one-quarter">
                <aside class="panel">
                    <p class="panel-heading">
                        Site structure
                    </p>
                    <tree :tree="structure" @click="selectNode"></tree>
                </aside>
            </div>

            <div class="column">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import tree from '../elements/tree/tree';
    import EditForm from './edit-form';
    import structure from "../../mixins/api/structure";
    import site_structure from "../../mixins/app/site_structure";

    export default {
        mixins: [structure, site_structure],
        created() {
            this.getStructureTree()
                .then(response => {
                    this.setSiteStructure(response.data);

                    if (this.$route.name === 'edit_structure') {
                        this.setActiveStructure(this.$route.params.id);
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        methods: {
            selectNode(node) {
                this.setActiveStructure(node.id);
                this.$router.push({name: 'edit_structure', params: {id: node.id}})
            }
        },
        components: {
            tree,
            EditForm
        }
    }
</script>

<style scoped>

</style>
