<template>
    <aside class="panel">
        <p class="panel-heading">
            {{tree.name}}
        </p>
        <ul class="menu-list">
            <folder v-if="tree.children" v-for="child in tree.children" :key="child.id" :folder="child"/>
        </ul>
    </aside>
</template>

<script>
    import folder from './folder';

    export default {
        name: 'tree',
        props: {
            tree: {
                required: true,
                type: Object
            },
        },
        components: {
            folder
        },
        methods: {

        }
    }
</script>

<style scoped>

</style>
