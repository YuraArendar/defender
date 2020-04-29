<template>
    <ul class="menu-list">
        <folder v-for="item in for_render" :key="item.id" :folder="item"/>
    </ul>
</template>

<script>
    import folder from './folder';

    export default {
        name: 'tree',
        data() {
            return {
                for_render: this.tree
            }
        },
        props: {
            tree: {
                required: true,
            },
        },
        components: {
            folder
        },
        created() {
            this.initClickEvent();
        },
        methods: {
            initClickEvent(selected) {
                this.$root.$on('selectTreeFolder', selected => {
                    this.$emit('click', selected);
                })
            }
        },
        watch: {
            tree(tree) {
                this.for_render = tree;
            }
        }
    }
</script>

<style scoped>

</style>
