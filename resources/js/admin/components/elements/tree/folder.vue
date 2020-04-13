<template>
    <li>
        <a>{{folder.name}}</a>
        <ul v-if="folder.children" class="menu-list">
            <folder v-for="child in folder.children" :key="child.id" :folder="child"/>
        </ul>
    </li>
</template>

<script>
    export default {
        name: 'folder',
        props: {
            folder: {
                required: true,
                type: Object
            },
        }
    }
</script>

<style scoped>

</style>
