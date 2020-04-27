<template>
    <aside class="panel">
        <p class="panel-heading">
            {{name}}
        </p>
        <ul class="menu-list">
            <folder v-for="item in tree" :key="item.id" :folder="item"/>
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
            },
            name: {
                required: false,
                type: String
            }
        },
        components: {
            folder
        },
        created() {
            this.initClickEvent();
        },
        methods: {
            initClickEvent() {
                this.$root.$on('selectTreeFolder', selected => {
                    this.$emit('click', selected);
                })
            }
        }
    }
</script>

<style scoped>

</style>
