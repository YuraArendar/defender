<template>
    <div>
        <div class="columns">
            <div v-if="structure !== null" class="column is-one-quarter">
                <tree :tree="structure" :name="'Site structure'" @click="selectNode"></tree>
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
    import {mapMutations} from "vuex";
    import {SET_ACTIVE_STRUCTURE} from "../../store/app/mutations";

    export default {
        mixins: [structure],
        data() {
            return {
                structure: null
            }
        },
        created() {
            this.getStructureTree()
                .then(response => {
                    this.structure = response.data;

                    if (this.$route.name === 'edit_structure') {
                        this[SET_ACTIVE_STRUCTURE](parseInt(this.$route.params.id));
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        methods: {
            ...mapMutations('app', [SET_ACTIVE_STRUCTURE]),
            selectNode(node) {
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
