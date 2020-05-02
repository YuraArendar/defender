<template>
    <ul class="menu-list">
        <folder v-for="(item, index) in for_render" :key="item.id" :order="index" :count="tree.length" :folder="item"/>
    </ul>
</template>

<script>
    import folder from './folder';

    export default {
        name: 'tree',
        data() {
            return {
                for_render: this.tree,
                selected_node: null
            }
        },
        created() {
            this.selected_node = this.selected;
        },
        props: {
            tree: {
                required: true,
            },
            sortable: {
                required: false,
                default: false
            },
            selected: {
                required: false,
                default: null
            }
        },
        components: {
            folder
        },
        watch: {
            tree(tree) {
                this.for_render = tree;
            },
            selected(selectedItem) {
                this.selected_node = selectedItem;
            }
        }
    }
</script>

<style scoped>

</style>
