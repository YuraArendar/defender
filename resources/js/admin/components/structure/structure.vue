<template>
    <div>
        <div class="columns">
            <div v-if="showTreeSidebar" class="column is-one-quarter">
                <aside class="panel">
                    <p class="panel-heading">
                        Site structure
                    </p>
                    <tree :tree="structure" @click="selectNode" :selected="activeStructure" :sortable="true" @up="up" @down="down"></tree>
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
    import {mapGetters} from "vuex";
    import {GET_ACTIVE_STRUCTURE} from "../../store/app/getters";

    export default {
        mixins: [structure, site_structure],
        created() {
            this.rebuildStructure();
            if (this.$route.params.id) {
                this.setActiveStructure(this.$route.params.id);
            }
        },
        methods: {
            ...mapGetters('app', [GET_ACTIVE_STRUCTURE]),
            selectNode(node) {
                this.setActiveStructure(node.id);
                this.$router.push({name: 'edit_structure', params: {id: node.id}})
            },
            up(node) {
                this.moveUp(node.id)
                    .then(response => {
                       this.rebuildStructure()
                    })
            },
            down(node) {
                this.moveDown(node.id)
                    .then(response => {
                        this.rebuildStructure()
                    })
            },
            rebuildStructure() {
                this.getStructureTree()
                    .then(response => {
                        this.setSiteStructure(response.data);

                        if (this.$route.name === 'edit_structure') {
                            this.setActiveStructure(this.$route.params.id);
                        }
                    })
            }
        },
        computed: {
            showTreeSidebar() {
                return this.structure && this.structure.length > 0
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
