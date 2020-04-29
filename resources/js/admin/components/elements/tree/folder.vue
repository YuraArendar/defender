<template>
    <li>
        <a @click.prevent="onClick" :class="{'is-active' : active}">{{folder.name}}</a>
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
        },
        methods: {
            onClick() {
                let element = this.$parent;

                while (true) {
                    if (element.$options._componentTag === 'tree') {
                        element.$emit('click', this.folder);
                        break;
                    }

                    element = element.$parent;
                }
            },
        },
        computed: {
            active() {
                return this.$store.state.app.active_structure === this.folder.id
            }
        }
    }
</script>

<style scoped>

</style>
